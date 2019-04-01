<?php
/**
 * Customize component.
 *
 * Integrates the theme's settings into the customizer.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Customize;

use WP_Customize_Manager;
use WP_Customize_Color_Control;

use Hybrid\App;
use Hybrid\Contracts\Bootable;
use Exhale\Template\FeaturedImage;
use Exhale\Template\Footer;

use Exhale\Color\CustomizeColors;
use Exhale\Font\Family\Choices  as FontFamilyChoices;
use Exhale\Font\Family\Settings as FontFamilySettings;
use Exhale\Image\Filter\Filters as ImageFilters;
use Exhale\Image\Size\Sizes     as ImageSizes;

use function Exhale\asset;

/**
 * Handles setting up everything we need for the customizer.
 *
 * @link   https://developer.wordpress.org/themes/customize-api
 * @since  1.0.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Adds actions on the appropriate customize action hooks.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		// Register panels, sections, settings, controls, and partials.
		array_map( function( $callback ) {
			add_action( 'customize_register', [ $this, $callback ] );
		}, [
			'registerPanels',
			'registerSections',
			'registerSettings',
			'registerControls',
			'registerPartials'
		] );

		// Enqueue scripts and styles.
		add_action( 'customize_controls_enqueue_scripts', [ $this, 'controlsEnqueue'] );
		add_action( 'customize_preview_init',             [ $this, 'previewEnqueue' ] );
	}

	/**
	 * Callback for registering panels.
	 *
	 * @link   https://developer.wordpress.org/themes/customize-api/customizer-objects/#panels
	 * @since  1.0.0
	 * @access public
	 * @param  WP_Customize_Manager  $manager  Instance of the customize manager.
	 * @return void
	 */
	public function registerPanels( WP_Customize_Manager $manager ) {

		$manager->add_panel( 'theme_options', [
			'title' => __( 'Theme Options' )
		] );
	}

	/**
	 * Callback for registering sections.
	 *
	 * @link   https://developer.wordpress.org/themes/customize-api/customizer-objects/#sections
	 * @since  1.0.0
	 * @access public
	 * @param  WP_Customize_Manager  $manager  Instance of the customize manager.
	 * @return void
	 */
	public function registerSections( WP_Customize_Manager $manager ) {

		// Move the color section to our theme options panel.
		$manager->get_section( 'colors' )->panel = 'theme_options';

		// Add sections under the theme options panel.
		$sections = [
			'fonts'  => __( 'Fonts' ),
			'media'  => __( 'Media' ),
			'footer' => __( 'Footer' )
		];

		array_map( function( $name, $title ) use ( $manager ) {

			$manager->add_section( $name, [
				'panel' => 'theme_options',
				'title' => $title
			] );

		}, array_keys( $sections ), $sections );
	}

	/**
	 * Callback for registering settings.
	 *
	 * @link   https://developer.wordpress.org/themes/customize-api/customizer-objects/#settings
	 * @since  1.0.0
	 * @access public
	 * @param  WP_Customize_Manager  $manager  Instance of the customize manager.
	 * @return void
	 */
	public function registerSettings( WP_Customize_Manager $manager ) {

		// Update the `transform` property of core WP settings.
		$settings = [
			$manager->get_setting( 'blogname' ),
			$manager->get_setting( 'blogdescription' )
		];

		array_walk( $settings, function( &$setting ) {
			$setting->transport = 'postMessage';
		} );

		// Registers the color settings.
		array_map( function( $setting ) use ( $manager ) {

			$manager->add_setting( $setting->modName(), [
				'default'              => maybe_hash_hex_color( $setting->color() ),
				'sanitize_callback'    => 'sanitize_hex_color_no_hash',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
				'transport'            => 'postMessage'
			] );

		}, App::resolve( CustomizeColors::class )->all() );

		// Registers the font family settings.
		array_map( function( $setting ) use ( $manager ) {

			$manager->add_setting( $setting->modName(), [
				'default'           => $setting->family(),
				'sanitize_callback' => 'sanitize_key',
				'transport'         => 'postMessage'
			] );

		}, App::resolve( FontFamilySettings::class )->all() );

		// Featured image size setting.
		$manager->add_setting( 'featured_image_size', [
			'default'           => 'exhale-wide',
			'sanitize_callback' => 'sanitize_key',
			'transport'         => 'postMessage'
		] );

		// Image filter settings.
		$manager->add_setting( 'image_default_filter_function', [
			'default'           => 'grayscale',
			'sanitize_callback' => 'sanitize_key',
			'transport'         => 'postMessage'
		] );

		$manager->add_setting( 'image_default_filter_amount', [
			'default'           => 100,
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage'
		] );

		$manager->add_setting( 'image_hover_filter_amount', [
			'default'           => 0,
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage'
		] );

		// Register footer settings.
		$manager->add_setting( 'powered_by', [
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
			'transport'         => 'postMessage'
		] );

		$manager->add_setting( 'footer_credit', [
			'default'           => sprintf( __( 'Powered by %s.' ), \Hybrid\Theme\render_link() ),
			'sanitize_callback' => function( $value ) {
				return wp_kses( $value, Footer::allowedTags() );
			},
			'transport'         => 'postMessage'
		] );
	}

	/**
	 * Callback for registering controls.
	 *
	 * @link   https://developer.wordpress.org/themes/customize-api/customizer-objects/#controls
	 * @since  1.0.0
	 * @access public
	 * @param  WP_Customize_Manager  $manager  Instance of the customize manager.
	 * @return void
	 */
	public function registerControls( WP_Customize_Manager $manager ) {

		$manager->register_control_type( Controls\ImageFilter::class );

		// Registers the color controls.
		array_map( function( $setting ) use ( $manager ) {

			$manager->add_control(
				new WP_Customize_Color_Control( $manager, $setting->modName(), [
					'section'     => 'colors',
					'label'       => esc_html( $setting->label() ),
					'description' => esc_html( $setting->description() )
				] )
			);

		}, App::resolve( CustomizeColors::class )->all() );

		// Registers the font family controls.
		array_map( function( $setting ) use ( $manager ) {

			// @todo - Use Hybrid Customize select group to separate
			// web safe and Google fonts.
			$manager->add_control( $setting->modName(), [
				'section'     => 'fonts',
				'type'        => 'select',
				'label'       => esc_html( $setting->label() ),
				'description' => $setting->description(),
				'choices'     => App::resolve( FontFamilyChoices::class )->customizeChoices()
			] );

		}, App::resolve( FontFamilySettings::class )->all() );

		// Featured image size control.
		$manager->add_control( 'featured_image_size', [
			'section' => 'media',
			'type'    => 'select',
			'label'   => esc_html__( 'Featured Image Size' ),
			'description' => sprintf(
				esc_html__( 'For image to be sized correctly, make sure to regenerate them using a plugin such as %s if you have switched from a previous theme.' ),
				sprintf( '<a href="https://wordpress.org/plugins/regenerate-thumbnails/">%s</a>', esc_html__( 'Regnerate Thumbnails' ) )
			),
			'choices' => App::resolve( ImageSizes::class )->customizeChoices()
		] );

		// Image filters.
		$manager->add_control(
			new Controls\ImageFilter( $manager, 'image_filter', [
				'section'     => 'media',
				'label'       => __( 'Image Filter' ),
				'description' => __( 'CSS filters to apply to images across the site.' ),
				'filters'     => App::resolve( ImageFilters::class ),
				'settings'    => [
					'function'       => 'image_default_filter_function',
					'default_amount' => 'image_default_filter_amount',
					'hover_amount'   => 'image_hover_filter_amount'
				]
			] )
		);

		// Register the footer controls.
		$manager->add_control( 'powered_by', [
			'section'  => 'footer',
			'type'     => 'checkbox',
			'label'    => __( 'Show random "powered by" credit text.' )
		] );

		// Footer credit control.
		$manager->add_control( 'footer_credit', [
			'section'         => 'footer',
			'type'            => 'textarea',
			'label'           => __( 'Custom Footer Text' ),
			'active_callback' => function( $control ) {
				return ! $control->manager->get_setting( 'powered_by' )->value();
			}
		] );
	}

	/**
	 * Callback for registering partials.
	 *
	 * @link   https://developer.wordpress.org/themes/customize-api/tools-for-improved-user-experience/#selective-refresh-fast-accurate-updates
	 * @since  1.0.0
	 * @access public
	 * @param  WP_Customize_Manager  $manager  Instance of the customize manager.
	 * @return void
	 */
	public function registerPartials( WP_Customize_Manager $manager ) {

		// If the selective refresh component is not available, bail.
		if ( ! isset( $manager->selective_refresh ) ) {
			return;
		}

		// Selectively refreshes the title in the header.
		$manager->selective_refresh->add_partial( 'blogname', [
			'selector'        => '.app-header__title-link',
			'render_callback' => function() {
				return get_bloginfo( 'name', 'display' );
			}
		] );

		// Selectively refreshes the tagline in the header.
		$manager->selective_refresh->add_partial( 'blogdescription', [
			'selector'        => '.app-header__description',
			'render_callback' => function() {
				return get_bloginfo( 'description', 'display' );
			}
		] );

		// Featured image size.
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

		// Footer credit partial.
		$manager->selective_refresh->add_partial( 'powered_by', [
			'selector'            => '.app-footer__credit',
			'container_inclusive' => true,
			'settings'            => [ 'powered_by', 'footer_credit' ],
			'render_callback'     => function() {
				return Footer::renderCredit();
			}
		] );
	}

	/**
	 * Register or enqueue scripts/styles for the controls that are output
	 * in the controls frame.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function controlsEnqueue() {

		wp_enqueue_script(
			'exhale-customize-controls',
			asset( 'js/customize-controls.js' ),
			[ 'customize-controls' ],
			null,
			true
		);

		wp_enqueue_style(
			'exhale-customize-controls',
			asset( 'css/customize-controls.css' ),
			[],
			null
		);

		wp_localize_script( 'exhale-customize-controls', 'exhaleCustomizeControls', [
			'imageFilters' => App::resolve( ImageFilters::class )
		] );
	}

	/**
	 * Register or enqueue scripts/styles for the live preview frame.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function previewEnqueue() {

		wp_enqueue_script(
			'exhale-customize-preview',
			asset( 'js/customize-preview.js' ),
			[ 'customize-preview' ],
			null,
			true
		);

		wp_localize_script( 'exhale-customize-preview', 'exhaleCustomizePreview', [
			'customizeColors'    => App::resolve( CustomizeColors::class    ),
			'fontFamilySettings' => App::resolve( FontFamilySettings::class ),
			'fontFamilyChoices'  => App::resolve( FontFamilyChoices::class  )
		] );
	}
}
