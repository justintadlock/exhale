<?php
/**
 * Font Family Component.
 *
 * Manages the font family component.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Font\Family;

use WP_Customize_Manager;

use Hybrid\Contracts\Bootable;
use Exhale\Tools\Config;
use Exhale\Tools\CustomProperties;

/**
 * Font component class.
 *
 * @since  1.0.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Stores the font families object.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    Families
	 */
	protected $families;

	/**
	 * Stores the font family settings object.
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
	 * @param  Families  $families
	 * @param  Settings  $settings
	 * @return void
	 */
	public function __construct( Families $families, Settings $settings, CustomProperties $properties ) {
		$this->families   = $families;
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

		// Register default families and settings.
		add_action( 'exhale/font/families/register',        [ $this, 'registerDefaultFamilies' ] );
		add_action( 'exhale/font/family/settings/register', [ $this, 'registerDefaultSettings' ] );

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

		// Hooks for registering custom fonts and settings.
		do_action( 'exhale/font/families/register',        $this->families );
		do_action( 'exhale/font/family/settings/register', $this->settings );

		// Adds each font setting as a custom property.
		foreach ( $this->settings as $setting ) {
			$this->properties->add(
				$setting->property(),
			 	$this->families->get( $setting->mod() )->stack()
			);
		}
	}

	/**
	 * Registers default families.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  Families  $families
	 * @return void
	 */
	public function registerDefaultFamilies( $families ) {

		foreach ( Config::get( 'font-families' ) as $name => $options ) {
			$families->add( $name, $options );
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

		foreach ( Config::get( 'font-family-settings' ) as $name => $options ) {
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
