<?php
/**
 * Color component.
 *
 * Handles the theme color feature.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Color\Setting;

use WP_Customize_Manager;
use WP_Customize_Color_Control;

use Hybrid\Contracts\Bootable;
use Exhale\Tools\Config;
use Exhale\Tools\CustomProperties;

/**
 * Color component class.
 *
 * @since  1.0.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Customize colors.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    Settings
	 */
	protected $settings;

	/**
	 * CSS custom properties.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    CustomProperties
	 */
	protected $properties;

	/**
	 * Creates the component object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  Settings         $settings
	 * @param  CustomProperties $properties
	 * @return void
	 */
	public function __construct( Settings $settings, CustomProperties $properties ) {
		$this->settings   = $settings;
		$this->properties = $properties;
	}

	/**
	 * Bootstraps the component.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		// Run registration on `after_setup_theme`.
		add_action( 'after_setup_theme', [ $this, 'register' ] );

		// Register color settings.
		add_action( 'exhale/color/setting/register', [ $this, 'registerDefaultSettings' ] );

		// Add customizer settings and controls.
		add_action( 'customize_register', [ $this, 'customizeRegister'] );
	}

	/**
	 * Runs the register action and adds theme support.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		// Hook for registering custom color settings.
		do_action( 'exhale/color/setting/register', $this->settings );

		// Adds each color as a custom property.
		foreach ( $this->settings as $setting ) {
			$this->properties->add( 'color-' . $setting->name(), $setting );
		}
	}

	/**
	 * Registers default customize color settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  Settings  $settings
	 * @return void
	 */
	public function registerDefaultSettings( Settings $settings ) {

		$base   = Config::get( '_settings-color' );
		$config = Config::get( 'settings-color'  );

		foreach ( $base as $name => $options ) {

			if ( isset( $config[ $name ] ) ) {
				$options = array_merge( $options, $config[ $name ] );
			}

			$settings->add( $name, $options );
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

		// Registers the color settings.
		array_map( function( $setting ) use ( $manager ) {

			$manager->add_setting( $setting->modName(), [
				'default'              => maybe_hash_hex_color( $setting->color() ),
				'sanitize_callback'    => 'sanitize_hex_color_no_hash',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
				'transport'            => 'postMessage'
			] );

		}, $this->settings->all() );

		// Registers the color controls.
		array_map( function( $setting ) use ( $manager ) {

			$manager->add_control(
				new WP_Customize_Color_Control( $manager, $setting->modName(), [
					'section'     => 'colors',
					'label'       => esc_html( $setting->label() ),
					'description' => esc_html( $setting->description() )
				] )
			);

		}, $this->settings->all() );
	}
}
