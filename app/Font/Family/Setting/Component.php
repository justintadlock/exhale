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
use Hybrid\Customize\Controls\SelectGroup;
use Exhale\Font\Family\Families;
use Exhale\Tools\Config;
use Exhale\Tools\CustomProperties;

use function Hybrid\Font\enqueue as enqueue_font;

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

		// Enqueue fonts.
		add_action( 'wp_enqueue_scripts',          [ $this, 'enqueue' ], 5 );
		add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue' ], 5 );
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
			$this->properties->add( 'font-family-' . $setting->name(), $setting );
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

		$base   = Config::get( '_settings-font-family' );
		$config = Config::get( 'settings-font-family'  );

		$config = is_array( $config ) ? $config : [];

		foreach ( $base as $name => $options ) {

			if ( isset( $config[ $name ] ) ) {
				$options = array_merge( $options, $config[ $name ] );
			}

			$settings->add( $name, $options );
		}
	}

	/**
	 * Enqueues any scripts/styles necessary for font settings.
	 *
	 * @since  1.1.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		$fonts = $this->googleFonts();

		if ( $fonts ) {
			enqueue_font( 'exhale', [
				'family' => $fonts,
				'subset' => [
					'latin',
					'latin-ext'
				]
			] );
		}
	}

	/**
	 * Returns an array of Google fonts to load.
	 *
	 * @since  1.1.0
	 * @access protected
	 * @return array
	 */
	protected function googleFonts() {
		$fonts = [];

		foreach ( $this->settings as $setting ) {

			$family = $this->families->get( $setting->mod() );

			if ( $family->isGoogleFont() && ! isset( $fonts[ $family->name() ] ) ) {
				$fonts[ $family->name() ] = sprintf(
					'%s:400,400i,700,700i',
					$family->googleName()
				);
			}
		}

		return $fonts;
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

			$manager->add_control( new SelectGroup( $manager, $setting->modName(), [
				'section'     => 'fonts',
				'label'       => esc_html( $setting->label() ),
				'description' => $setting->description(),
				'choices'     => $this->families->customizeChoices()
			] ) );

		}, $this->settings->all() );
	}
}
