<?php
/**
 * Customize component.
 *
 * Integrates the theme's settings into the customizer.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Customize;

use WP_Customize_Manager;
use WP_Customize_Color_Control;

use Hybrid\App;
use Hybrid\Contracts\Bootable;
use Exhale\Template\Footer;

use Exhale\Color\Setting\Settings as ColorSettings;
use Exhale\Font\Family\Families   as FontFamilies;
use Exhale\Font\Setting\Settings  as FontSettings;
use Exhale\Font\Style\Styles      as FontStyles;
use Exhale\Image\Filter\Filters   as ImageFilters;
use Exhale\Layout\Layouts;
use Exhale\Tools\Mod;

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
			'title' => __( 'Theme Options', 'exhale' )
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

		$colors   = $manager->get_section( 'colors' );
		$bg_image = $manager->get_section( 'background_image' );

		// Add the fonts section.
		$manager->add_section( 'fonts', [
			'panel'    => 'theme_options',
			'title'    => __( 'Fonts',  'exhale' ),
			'priority' => 10
		] );

		// Move the color section and set its priority.
		$colors->panel    = 'theme_options';
		$colors->priority = 20;

		// Move the background image section and set its priority.
		$bg_image->panel    = 'theme_options';
		$bg_image->priority = 25;

		// Add the media section.
		$manager->add_section( 'media', [
			'panel'    => 'theme_options',
			'title'    => __( 'Media',  'exhale' ),
			'priority' => 30
		] );

		// Add the footer section.
		$manager->add_section( 'footer', [
			'panel'    => 'theme_options',
			'title'    => __( 'Footer',  'exhale' ),
			'priority' => 40
		] );
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

		// Register footer settings.
		$manager->add_setting( 'powered_by', [
			'default'           => Mod::fallback( 'powered_by' ),
			'sanitize_callback' => 'wp_validate_boolean',
			'transport'         => 'postMessage'
		] );

		$manager->add_setting( 'footer_credit', [
			// Translators: %s is the theme link.
			'default'           => Mod::fallback( 'footer_credit' ),
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

		// Register JS control types.
		$manager->register_control_type( Controls\ImageFilter::class );
		$manager->register_control_type( Controls\Font::class        );

		// Change background color control labels.
		$bg_color              = $manager->get_control( 'background_color' );
		$bg_color->label       = __( 'Background', 'exhale' );
		$bg_color->description = __( 'Background color used for the site.', 'exhale' );

		// Register the footer controls.
		$manager->add_control( 'powered_by', [
			'section'  => 'footer',
			'type'     => 'checkbox',
			'label'    => __( 'Show random "powered by" credit text.', 'exhale' )
		] );

		// Footer credit control.
		$manager->add_control( 'footer_credit', [
			'section'         => 'footer',
			'type'            => 'textarea',
			'label'           => __( 'Custom Footer Text', 'exhale' ),
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
			'fontFamilies'  => App::resolve( FontFamilies::class ),
			'fontStyles'    => App::resolve( FontStyles::class   ),
			'imageFilters'  => App::resolve( ImageFilters::class )
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
			'colorSettings' => App::resolve( ColorSettings::class ),
			'fontSettings'  => App::resolve( FontSettings::class  ),
			'fontFamilies'  => App::resolve( FontFamilies::class  ),
			'fontStyles'    => App::resolve( FontStyles::class    ),
			'layouts'       => App::resolve( Layouts::class       )
		] );
	}
}
