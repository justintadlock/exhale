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
use Exhale\Tools\Collection;
use Hybrid\App;
use Hybrid\Contracts\Bootable;

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
	 * Array of `Customizable` components bound to the container.
	 *
	 * @since  2.1.0
	 * @access protected
	 * @var    array
	 */
	protected $components = [];

	/**
	 * Sets up initial object properties.
	 *
	 * @since  2.1.0
	 * @access public
	 * @param  array  $components  Array `Customizable` component names.
	 * @return void
	 */
	public function __construct( array $components = [] ) {
		$this->components = $components;
	}

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

		$panels = [
			'theme_global'  => __( 'Theme: Global',  'exhale' ),
			'theme_header'  => __( 'Theme: Header',  'exhale' ),
			'theme_content' => __( 'Theme: Content', 'exhale' ),
			'theme_footer'  => __( 'Theme: Footer',  'exhale' )
		];

		foreach ( $panels as $panel => $label ) {
			$manager->add_panel( $panel, [
				'title'    => $label,
				'priority' => 100
			] );
		}

		// Register component panels.
		foreach ( $this->components as $component ) {
			App::resolve( $component )->registerPanels( $manager );
		}
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

		// -------------------------------------------------------------
		// Global sections.
		// -------------------------------------------------------------

		$manager->add_section( 'theme_global_layout', [
			'panel'    => 'theme_global',
			'title'    => __( 'Layout', 'exhale' ),
			'priority' => 5
		] );

		$manager->add_section( 'theme_global_typography', [
			'panel'    => 'theme_global',
			'title'    => __( 'Typography', 'exhale' ),
			'priority' => 10
		] );

		// Use the core colors section for the global panel.
		$colors           = $manager->get_section( 'colors' );
		$colors->panel    = 'theme_global';
		$colors->priority = 15;

		// Move the background image section and set its priority.
		$bg_image           = $manager->get_section( 'background_image' );
		$bg_image->panel    = 'theme_global';
		$bg_image->priority = 20;

		$manager->add_section( 'theme_global_media', [
			'panel'    => 'theme_global',
			'title'    => __( 'Media', 'exhale' ),
			'priority' => 25
		] );

		// Move the additional CSS section.
		$custom_css        = $manager->get_section( 'custom_css' );
		$custom_css->panel = 'theme_global';

		// -------------------------------------------------------------
		// Header sections.
		// -------------------------------------------------------------

		$manager->add_section( 'theme_header_layout', [
			'panel'    => 'theme_header',
			'title'    => __( 'Layout', 'exhale' ),
			'priority' => 5
		] );

		$manager->add_section( 'theme_header_colors', [
			'panel'    => 'theme_header',
			'title'    => __( 'Colors', 'exhale' ),
			'priority' => 15
		] );

		$manager->add_section( 'theme_header_background', [
			'panel'     => 'theme_header',
			'title'     => __( 'Background', 'exhale' ),
			'priority'  => 15
		] );

		// Customize the title/tagline section.
		$title_tagline           = $manager->get_section( 'title_tagline' );
		$title_tagline->panel    = 'theme_header';
		$title_tagline->title    = __( 'Branding', 'exhale' );
		$title_tagline->priority = 20;

		// -------------------------------------------------------------
		// Content sections.
		// -------------------------------------------------------------

		$manager->add_section( 'theme_content_colors', [
			'panel'    => 'theme_content',
			'title'    => __( 'Colors', 'exhale' ),
			'priority' => 15
		] );

		$manager->add_section( 'theme_content_background', [
			'panel'     => 'theme_content',
			'title'     => __( 'Background', 'exhale' ),
			'priority'  => 15
		] );

		// Customize the static front page section.
		$static_front           = $manager->get_section( 'static_front_page' );
		$static_front->panel    = 'theme_content';
		$static_front->priority = 20;

		// -------------------------------------------------------------
		// Footer sections.
		// -------------------------------------------------------------

		$manager->add_section( 'theme_footer_colors', [
			'panel'    => 'theme_footer',
			'title'    => __( 'Colors', 'exhale' ),
			'priority' => 15
		] );

		$manager->add_section( 'theme_footer_background', [
			'panel'     => 'theme_footer',
			'title'     => __( 'Background: Footer', 'exhale' ),
			'priority'  => 15
		] );

		$manager->add_section( 'theme_sidebar_footer_background', [
			'panel'     => 'theme_footer',
			'title'     => __( 'Background: Sidebar', 'exhale' ),
			'priority'  => 15
		] );

		$manager->add_section( 'theme_footer_sidebar', [
			'panel'    => 'theme_footer',
			'title'    => __( 'Sidebar', 'exhale' ),
			'description' => sprintf(
				'<a class="button button-secondary" href="javascript:wp.customize.panel( \'widgets\' ).focus();">%s</a>',
				__( 'Add Footer Widgets &rarr;', 'exhale' )
			),
			'priority' => 20
		] );

		$manager->add_section( 'theme_footer_credit', [
			'panel'    => 'theme_footer',
			'title'    => __( 'Credit', 'exhale' ),
			'priority' => 25
		] );

		// -------------------------------------------------------------
		// Component sections.
		// -------------------------------------------------------------

		foreach ( $this->components as $component ) {
			App::resolve( $component )->registerSections( $manager );
		}
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

		// Register component settings.
		foreach ( $this->components as $component ) {
			App::resolve( $component )->registerSettings( $manager );
		}

		$manager->add_setting( 'header_sticky', [
			'default'           => \Exhale\Tools\Mod::fallback( 'header_sticky' ),
			'sanitize_callback' => 'wp_validate_boolean',
			'transport'         => 'postMessage'
		] );

		$manager->add_setting( 'branding_sep', [
			'default'           => \Exhale\Tools\Mod::fallback( 'branding_sep' ),
			'sanitize_callback' => 'sanitize_text_field',
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
		$manager->register_control_type( Controls\BackgroundPosition::class );
		$manager->register_control_type( Controls\BackgroundSvg::class      );
		$manager->register_control_type( Controls\ImageFilter::class        );
		$manager->register_control_type( Controls\Typography::class         );

		// Change background color control labels.
		$bg_color              = $manager->get_control( 'background_color' );
		$bg_color->label       = __( 'Background', 'exhale' );
		$bg_color->description = __( 'Background color used for the site.', 'exhale' );

		// Register component controls.
		foreach ( $this->components as $component ) {
			App::resolve( $component )->registerControls( $manager );
		}

		// Sticky header control.
		$manager->add_control( 'header_sticky', [
			'section'     => 'theme_header_layout',
			'type'        => 'checkbox',
			'label'       => __( 'Always stick header to top of screen?', 'exhale' ),
			'description' => __( 'Note: Header is sticky on mobile by default.', 'exhale' )
		] );

		$choices  = [ '' => '' ];

		foreach ( \Exhale\Tools\Config::get( 'character-entities' ) as $entity ) {
			$choices[ $entity ] = esc_html( $entity );
		}

		// Branding separator control.
		$manager->add_control( 'branding_sep', [
			'section'     => 'title_tagline',
			'type'        => 'select',
			'label'       => __( 'Separator', 'exhale' ),
			'description' => __( 'Character used as a separator between the title and tagline.', 'exhale' ),
			'choices'     => $choices
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

		// Register component partials.
		foreach ( $this->components as $component ) {
			App::resolve( $component )->registerPartials( $manager );
		}
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

		// Enqueue controls style.
		wp_enqueue_style(
			'exhale-customize-controls',
			asset( 'css/customize-controls.css' ),
			[],
			null
		);

		// Enqueue controls script.
		wp_enqueue_script(
			'exhale-customize-controls',
			asset( 'js/customize-controls.js' ),
			[ 'customize-controls' ],
			null,
			true
		);

		// Set up a new collection to store our JSON.
		$json = new Collection();

		// Register component controls JSON.
		foreach ( $this->components as $component ) {
			App::resolve( $component )->controlsJson( $json );
		}

		// Pass JSON to the controls script.
		wp_localize_script(
			'exhale-customize-controls',
			'exhaleCustomizeControls',
			$json
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

		// Enqueue preview style.
		wp_enqueue_style(
			'exhale-customize-preview',
			asset( 'css/customize-preview.css' ),
			[],
			null
		);

		// Enqueue preview script.
		wp_enqueue_script(
			'exhale-customize-preview',
			asset( 'js/customize-preview.js' ),
			[ 'customize-preview' ],
			null,
			true
		);

		// Set up a new collection to store our JSON.
		$json = new Collection();

		// Register component preview JSON.
		foreach ( $this->components as $component ) {
			App::resolve( $component )->previewJson( $json );
		}

		// Pass JSON to the preview script.
		wp_localize_script(
			'exhale-customize-preview',
			'exhaleCustomizePreview',
			$json
		);
	}
}
