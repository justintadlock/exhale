<?php
/**
 * Font Family Setting Component.
 *
 * Manages the font family setting component.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Font\Family\Setting;

use WP_Customize_Manager;

use Hybrid\Contracts\Bootable;
use Exhale\Font\Family\Families;
use Exhale\Tools\Config;
use Exhale\Tools\CustomProperties;

/**
 * Font family setting component class.
 *
 * @since  1.0.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Stores the font family settings object.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    Settings
	 */
	protected $settings;

	/**
	 * Stores the font families object.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    Families
	 */
	protected $families;

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
	 * @param  Settings          $settings
	 * @param  Families          $families
	 * @param  CustomProperties  $settings
	 * @return void
	 */
	public function __construct( Settings $settings, Families $families, CustomProperties $properties ) {
		$this->settings   = $settings;
		$this->families   = $families;
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

		// Register default settings.
		add_action( 'exhale/font/family/setting/register', [ $this, 'registerDefaultSettings' ] );

		// Add customizer settings and controls.
		add_action( 'customize_register', [ $this, 'customizeRegister'] );
	}

	/**
	 * Runs the register actions.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		// Hook for registering settings.
		do_action( 'exhale/font/family/setting/register', $this->settings );

		// Adds each font setting as a custom property.
		foreach ( $this->settings as $setting ) {
			$this->properties->add(
				$setting->property(),
			 	$this->families->get( $setting->mod() )->stack()
			);
		}
	}

	/**
	 * Registers default settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  Settings  $settings
	 * @return void
	 */
	public function registerDefaultSettings( Settings $settings ) {

		foreach ( Config::get( 'settings-font-family' ) as $name => $options ) {
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

		// Registers the font family settings.
		array_map( function( $setting ) use ( $manager ) {

			$manager->add_setting( $setting->modName(), [
				'default'           => $setting->family(),
				'sanitize_callback' => 'sanitize_key',
				'transport'         => 'postMessage'
			] );

		}, $this->settings->all() );

		// Registers the font family controls.
		array_map( function( $setting ) use ( $manager ) {

			$manager->add_control( $setting->modName(), [
				'section'     => 'fonts',
				'type'        => 'select',
				'label'       => esc_html( $setting->label() ),
				'description' => $setting->description(),
				'choices'     => $this->families->customizeChoices()
			] );

		}, $this->settings->all() );
	}
}
