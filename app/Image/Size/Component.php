<?php
/**
 * Image Size Component.
 *
 * Manages the image size component.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Image\Size;

use WP_Customize_Manager;

use Hybrid\Contracts\Bootable;
use Exhale\Tools\Config;
use Exhale\Template\FeaturedImage;

/**
 * Image size component class.
 *
 * @since  1.0.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Houses the `Sizes` collection.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    Sizes
	 */
	protected $sizes;

	/**
	 * Creates the component object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  Sizes  $sizes
	 * @return void
	 */
	public function __construct( Sizes $sizes ) {
		$this->sizes = $sizes;
	}

	/**
	 * Bootstraps the component.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		// Run registration on the `init` hook.
		add_action( 'init', [ $this, 'register' ], 5 );

		// Register default sizes.
		add_action( 'exhale/image/size/register', [ $this, 'registerDefaultSizes' ] );

		// Filter the image size names in the editor.
		add_filter( 'image_size_names_choose', [ $this, 'imageSizeNamesChoose' ] );

		// Add customizer settings and controls.
		add_action( 'customize_register', [ $this, 'customizeRegister'] );
	}

	/**
	 * Runs the register action and adds image sizes to WordPress.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		// Hook for registering custom image sizes.
		do_action( 'exhale/image/size/register', $this->sizes );

		// Registers image sizes with WordPress.  Note that the
		// `post-thumbnail` size should be properly register with the
		// `set_post_thumbnail_size()` function.
		foreach ( $this->sizes->all() as $size ) {

			if ( 'post-thumbnail' === $size->name() ) {
				set_post_thumbnail_size( $size->width(), $size->height(), $size->crop() );
			} else {
				add_image_size( $size->name(), $size->width(), $size->height(), $size->crop() );
			}
		}
	}

	/**
	 * Filter on the `image_size_names_choose` hook to add our custom image
	 * sizes to the image size dropdown in the post editor.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array  $sizes
	 * @return array
	 */
	public function imageSizeNamesChoose( $sizes ) {

		$new_sizes = [];

		foreach ( $this->sizes->all() as $size ) {
			$new_sizes[ $size->name() ] = esc_html( $size->label() );
		}

		return array_merge( $sizes, $new_sizes );
	}

	/**
	 * Registers the theme's default image sizes.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  Sizes  $sizes
	 * @return void
	 */
	public function registerDefaultSizes( Sizes $sizes ) {

		foreach ( Config::get( 'image-sizes' ) as $name => $options ) {
			$sizes->add( $name, $options );
		}
	}

	/**
	 * Customize register callback.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function customizeRegister( WP_Customize_Manager $manager ) {

		// Featured image size setting.
		$manager->add_setting( 'featured_image_size', [
			'default'           => 'exhale-wide',
			'sanitize_callback' => 'sanitize_key',
			'transport'         => 'postMessage'
		] );

		// Featured image size control.
		$manager->add_control( 'featured_image_size', [
			'section'     => 'media',
			'type'        => 'select',
			'priority'    => 5,
			'choices'     => $this->sizes->customizeChoices(),
			'label'       => esc_html__( 'Featured Image Size', 'exhale' ),
			'description' => sprintf(
				// Translators: %s is a plugin link.
				esc_html__( 'For images to be sized correctly, make sure to regenerate them using a plugin such as %s if you have switched from a previous theme.', 'exhale' ),
				sprintf( '<a href="https://wordpress.org/plugins/regenerate-thumbnails/">%s</a>', esc_html__( 'Regnerate Thumbnails', 'exhale' ) )
			)
		] );

		// Featured image size partial.
		$manager->selective_refresh->add_partial( 'featured_image_size', [
			'selector'            => '.entry__media',
			'container_inclusive' => true,
			'fallback_refresh'    => false,
			'render_callback'     => function( $partial, $context ) {
				return FeaturedImage::display( 'featured', [
					'post_id' => absint( $context['post_id'] )
				] );
			}
		] );
	}
}
