<?php
/**
 * Layout customize class.
 *
 * Adds customizer elements for the layout component.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Layout;

use WP_Customize_Manager;
use Exhale\Customize\Customizable;
use Exhale\Template\FeaturedImage;
use Exhale\Tools\Collection;
use Exhale\Tools\Mod;
use Hybrid\App;

/**
 * Layout customize class.
 *
 * @since  2.1.0
 * @access public
 */
class Customize extends Customizable {

	/**
	 * App layouts object.
	 *
	 * @since  2.1.0
	 * @access protected
	 * @var    Layouts
	 */
	protected $app_layouts;

	/**
	 * Loop layouts object.
	 *
	 * @since  2.1.0
	 * @access protected
	 * @var    Layouts
	 */
	protected $loop_layouts;

	/**
	 * Image sizes object.
	 *
	 * @since  2.1.0
	 * @access protected
	 * @var    \Exhale\Image\Size\Sizes
	 */
	protected $image_sizes;

	/**
	 * Registers customizer sections.
	 *
	 * @since  2.1.0
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function registerSections( WP_Customize_Manager $manager ) {

		$loop_layouts = [
			'blog'    => __( 'Blog',     'exhale' ),
			'archive' => __( 'Archives', 'exhale' )
		];

		$post_types = get_post_types( [ 'public' => true, '_builtin' => false, ], 'objects', 'and' );

		foreach ( $post_types as $type ) {
			$loop_layouts["archive_{$type->name}"] =sprintf(
				__( 'Archive: %s', 'exhale' ),
				$type->labels->name
			);
		}

		array_map( function( $type, $label ) use ( $manager ) {

			// Add the loop layout section.
			$manager->add_section( "theme_content_loop_{$type}", [
				'panel'       => 'theme_content',
				'title'       => $label,
			] );

		}, array_keys( $loop_layouts ), $loop_layouts );
	}

	/**
	 * Registers customizer settings.
	 *
	 * @since  2.1.0
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function registerSettings( WP_Customize_Manager $manager ) {

		$manager->add_setting( 'layout', [
			'default'           => Mod::fallback( 'layout' ),
			'sanitize_callback' => 'sanitize_key',
			'transport'         => 'postMessage'
		] );

		$types = array_merge(
			[ 'blog', 'archive' ],
			array_map( function( $name ) {
				return "archive_{$name}";
			}, get_post_types( [ 'public' => true, '_builtin' => false, ], 'names', 'and' ) )
		);

		array_map( function( $type ) use ( $manager ) {

			$manager->add_setting( "loop_{$type}_layout", [
				'default'           => Mod::fallback( "loop_{$type}_layout" ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_key'
			] );

			$manager->add_setting( "loop_{$type}_limit", [
				'default'           => Mod::fallback( "loop_{$type}_limit" ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'absint'
			] );

			$manager->add_setting( "loop_{$type}_width", [
				'default'           => Mod::fallback( "loop_{$type}_width" ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_key'
			] );

			$manager->add_setting( "loop_{$type}_columns", [
				'default'           => Mod::fallback( "loop_{$type}_columns" ),
				'transport'         => 'postMessage',
				'sanitize_callback' => function( $columns ) {
					return in_array( $columns, range( 2, 6 ) ) ? $columns : 4;
				}
			] );

			$manager->add_setting( "loop_{$type}_image_size", [
				'default'           => Mod::fallback( "loop_{$type}_image_size" ),
				'transport'         => 'postMessage',
				'sanitize_callback' => 'sanitize_key'
			] );

		}, $types );
	}

	/**
	 * Registers customizer controls.
	 *
	 * @since  2.1.0
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function registerControls( WP_Customize_Manager $manager ) {

		$manager->add_control( 'layout', [
			'section'     => 'theme_global_layout',
			'type'        => 'select',
			'label'       => __( 'Global Layout', 'exhale' ),
			'description' => __( 'Select the layout used across the site.', 'exhale' ),
			'choices'     => $this->app_layouts->customizeChoices()
		] );

		$types = array_merge(
			[ 'blog', 'archive' ],
			array_map( function( $name ) {
				return "archive_{$name}";
			}, get_post_types( [ 'public' => true, '_builtin' => false, ], 'names', 'and' ) )
		);

		array_map( function( $type ) use ( $manager ) {

			$manager->add_control( "loop_{$type}_layout", [
				'section'     => "theme_content_loop_{$type}",
				'type'        => 'select',
				'label'       => __( 'Layout', 'exhale' ),
				'description' => __( 'Layout style for the content area.', 'exhale' ),
				'choices'     => $this->loop_layouts->customizeChoices()
			] );

			$manager->add_control( "loop_{$type}_limit", [
				'section'     => "theme_content_loop_{$type}",
				'type'        => 'number',
				'label'       => __( 'Posts Per Page', 'exhale' ),
				'description' => __( 'Number of posts to display.', 'exhale' ),
				'input_attrs' => [
					'min' => 1
				]
			] );

			$manager->add_control( "loop_{$type}_width", [
				'section'     => "theme_content_loop_{$type}",
				'type'        => 'select',
				'label'       => __( 'Width', 'exhale' ),
				'description' => __( 'Width for the content area container.', 'exhale' ),
				// Note that the labels don't match the actual
				// sizes, which wouldn't make as much sense to
				// the user.
				'choices' => [
					'2xl'       => __( 'Medium',      'exhale' ),
					'3xl'       => __( 'Large',       'exhale' ),
					'4xl'       => __( 'Extra Large', 'exhale' ),
					'5xl'       => __( 'Huge',        'exhale' ),
					'6xl'       => __( 'Gargantuan',  'exhale' ),
					'7xl'       => __( 'Titanic',     'exhale' ),
					'full'      => __( 'Full',        'exhale' )
				],
				'active_callback' => function( $control ) use ( $type ) {

					$value = $control->manager->get_setting( "loop_{$type}_layout" )->value();

					return $this->loop_layouts->has( $value )
					       ? $this->loop_layouts->get( $value )->supportsWidth()
					       : $this->loop_layouts->get( 'blog' )->supportsWidth();
				}
			] );

			$manager->add_control( "loop_{$type}_columns", [
				'section'     => "theme_content_loop_{$type}",
				'type'        => 'number',
				'label'       => __( 'Columns', 'exhale' ),
				'description' => __( 'Number of columns to organize posts.', 'exhale' ),
				'input_attrs' => [
					'min' => 2,
					'max' => 6
				],
				'active_callback' => function( $control ) use ( $type ) {

					$value = $control->manager->get_setting( "loop_{$type}_layout" )->value();

					return $this->loop_layouts->has( $value )
					       ? $this->loop_layouts->get( $value )->supportsColumns()
					       : $this->loop_layouts->get( 'blog' )->supportsColumns();
				}
			] );

			$manager->add_control( "loop_{$type}_image_size", [
				'section'     => "theme_content_loop_{$type}",
				'type'        => 'select',
				'choices'     => $this->image_sizes->customizeChoices(
					$this->loop_layouts->get( Mod::get( "loop_{$type}_layout", 'blog' ) )->imageSizes()
				),
				'label'       => esc_html__( 'Featured Image Size', 'exhale' ),
				'description' => sprintf(
					// Translators: %s is a plugin link.
					esc_html__( 'For images to be sized correctly, regenerate them using the %s plugin.', 'exhale' ),
					sprintf( '<a href="https://wordpress.org/plugins/regenerate-thumbnails/">%s</a>', esc_html__( 'Regnerate Thumbnails', 'exhale' ) )
				),
				'active_callback' => function( $control ) use ( $type ) {

					$value = $control->manager->get_setting( "loop_{$type}_layout" )->value();

					$sizes = $this->loop_layouts->has( $value )
					         ? $this->loop_layouts->get( $value )->imageSizes()
					         : $this->loop_layouts->get( 'blog' )->imageSizes();

					return ! empty( $sizes );
				}
			] );

		}, $types );
	}

	/**
	 * Registers customizer partials.
	 *
	 * @since  2.1.0
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function registerPartials( WP_Customize_Manager $manager ) {

		$types = array_merge(
			[ 'blog', 'archive' ],
			array_map( function( $name ) {
				return "archive_{$name}";
			}, get_post_types( [ 'public' => true, '_builtin' => false, ], 'names', 'and' ) )
		);

		array_map( function( $type ) use ( $manager ) {

			// Content layout partial.
			$manager->selective_refresh->add_partial( "loop_{$type}_layout", [
				'selector'            => sprintf(
					'.loop--%s',
					str_replace( '_', '-', $type )
				),
				'container_inclusive' => true,
				'fallback_refresh'    => false,
				'render_callback'     => function( $partial, $context ) use ( $type ) {

					return App::resolve( 'view/engine' )->render(
						sprintf( 'loop/%s', \Exhale\Template\Loop::layout( $type )->name() ),
						! empty( $context['slugs'] ) ? $context['slugs'] : []
					);
				}
			] );

			$manager->selective_refresh->add_partial( "loop_{$type}_limit", [
				'selector'            => sprintf(
					'.loop--%s',
					str_replace( '_', '-', $type )
				),
				'container_inclusive' => true,
				'fallback_refresh'    => false,
				'render_callback'     => function( $partial, $context ) use ( $type )  {

					return App::resolve( 'view/engine' )->render(
						sprintf( 'loop/%s', \Exhale\Template\Loop::layout( $type )->name() ),
						! empty( $context['slugs'] ) ? $context['slugs'] : []
					);
				}
			] );

			// Featured image size partial.
			$manager->selective_refresh->add_partial( "loop_{$type}_image_size", [
				'selector'            => sprintf(
					'.loop--%s .entry__media',
					str_replace( '_', '-', $type )
				),
				'container_inclusive' => true,
				'fallback_refresh'    => false,
				'render_callback'     => function( $partial, $context ) {
					return FeaturedImage::display( 'featured', [
						'post_id' => absint( $context['post_id'] )
					] );
				}
			] );

		}, $types );
	}

	/**
	* Registers JSON for the customize controls script via `wp_localize_script()`.
	*
	* @since  2.1.0
	* @access public
	* @param  Collection  $json
	* @return void
	*/
	public function controlsJson( Collection $json ) {

		$types = array_merge(
			[ 'blog', 'archive' ],
			array_map( function( $name ) {
				return "archive_{$name}";
			}, get_post_types( [ 'public' => true, '_builtin' => false, ], 'names', 'and' ) )
		);

		$json->add( 'loopLayouts', $this->loop_layouts );
		$json->add( 'loopQueries', $types              );
		$json->add( 'imageSizes',  $this->image_sizes  );
	}

	/**
	* Registers JSON for the customize preview script via `wp_localize_script()`.
	*
	* @since  2.1.0
	* @access public
	* @param  Collection  $json
	* @return void
	*/
	public function previewJson( Collection $json ) {

		$types = array_merge(
			[ 'blog', 'archive' ],
			array_map( function( $name ) {
				return "archive_{$name}";
			}, get_post_types( [ 'public' => true, '_builtin' => false, ], 'names', 'and' ) )
		);

		$json->add( 'layouts',     $this->app_layouts );
		$json->add( 'loopQueries', $types             );
	}
}
