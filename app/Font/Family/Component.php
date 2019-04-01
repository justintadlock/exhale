<?php
/**
 * Font Family Component.
 *
 * Manages the font family component.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Font\Family;

use Hybrid\Contracts\Bootable;
use Exhale\Tools\Config;

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
	 * Creates the component object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  Families  $families
	 * @param  Settings  $settings
	 * @return void
	 */
	public function __construct( Families $families, Settings $settings ) {

		$this->families = $families;
		$this->settings = $settings;
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
	}

	/**
	 * Runs the register actions.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		do_action( 'exhale/font/families/register',        $this->families );
		do_action( 'exhale/font/family/settings/register', $this->settings );
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
	 * Returns an inline style for the colors.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function inlineStyle() {

		$css = '';

		foreach ( $this->settings as $setting ) {

			$css .= sprintf(
				'%s: %s;',
				esc_html( $setting->property() ),
				wp_strip_all_tags( $this->families->get( $setting->mod() )->stack() )
			);
		}

		return sprintf( ':root { %s }', $css );
	}
}
