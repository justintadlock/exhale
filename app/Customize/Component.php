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

use Exhale\Color\Settings       as ColorSettings;
use Exhale\Font\Family\Choices  as FontFamilyChoices;
use Exhale\Font\Family\Settings as FontFamilySettings;

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

		// Create a fonts section.
		$manager->add_section( 'fonts', [
			'panel' => 'theme_options',
			'title' => __( 'Fonts' )
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
	//		$manager->get_setting( 'blogdescription' ),
	//		$manager->get_setting( 'header_textcolor' ),
	//		$manager->get_setting( 'header_image' ),
	//		$manager->get_setting( 'header_image_data' )
		];

		array_walk( $settings, function( &$setting ) {
			$setting->transport = 'postMessage';
		} );

		// Registers the color settings.
		array_map( function( $setting ) use ( $manager ) {

			$manager->add_setting( $setting->modName(), [
				'default'              => $setting->default(),
				'sanitize_callback'    => 'sanitize_hex_color_no_hash',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
				'transport'            => 'postMessage'
			] );

		}, App::resolve( ColorSettings::class )->customizeColors() );

		// Registers the font family settings.
		array_map( function( $setting ) use ( $manager ) {

			$manager->add_setting( $setting->modName(), [
				'default'           => $setting->default(),
				'sanitize_callback' => 'sanitize_key',
				'transport'         => 'postMessage'
			] );

		}, App::resolve( FontFamilySettings::class )->all() );
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

		// Registers the color controls.
		array_map( function( $setting ) use ( $manager ) {

			$manager->add_control(
				new WP_Customize_Color_Control( $manager, $setting->modName(), [
					'section'     => 'colors',
					'label'       => esc_html( $setting->label() ),
					'description' => esc_html( $setting->description() )
				] )
			);

		}, App::resolve( ColorSettings::class )->customizeColors() );

		// Registers the font family controls.
		array_map( function( $setting ) use ( $manager ) {

			// @todo - Use Hybrid Customize select group to separate
			// web safe and Google fonts.
			$manager->add_control( $setting->modName(), [
				'section'     => 'fonts',
				'type'        => 'select',
				'label'       => esc_html( $setting->label() ),
				'description' => $setting->description(),
				'choices'     => App::resolve( FontFamilyChoices::class )->customizeChoices(),
				'default'     => maybe_hash_hex_color( $setting->default() )
			] );

		}, App::resolve( FontFamilySettings::class )->all() );
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

		// Selectively refreshes the title in the header when the core
		// WP `blogname` setting changes.
		$manager->selective_refresh->add_partial( 'blogname', [
			'selector'        => '.app-header__title-link',
			'render_callback' => function() {
				return get_bloginfo( 'name', 'display' );
			}
		] );
/*
		// Selectively refreshes the description in the header when the
		// core WP `blogdescription` setting changes.
		$manager->selective_refresh->add_partial( 'blogdescription', [
			'selector'        => 'title',
			'render_callback' => function() {
				return is_front_page() ? wp_get_document_title() : null;
			}
		] );
		*/

/*
		// Selectively refreshes the custom header if it doesn't support
		// videos. Core WP won't properly refresh output from its own
		// `the_custom_header_markup()` function unless video is supported.
		if ( ! current_theme_supports( 'custom-header', 'video' ) ) {

			$manager->selective_refresh->add_partial( 'header_image', [
				'selector'            => '#wp-custom-header',
				'render_callback'     => 'the_custom_header_markup',
				'container_inclusive' => true,
			] );
		}
		*/
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
			'colorSettings'      => App::resolve( ColorSettings::class      ),
			'fontFamilySettings' => App::resolve( FontFamilySettings::class ),
			'fontFamilyChoices'  => App::resolve( FontFamilyChoices::class  )
		] );
	}
}
