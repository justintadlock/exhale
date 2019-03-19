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
	 * Stores the font family settings object.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    Settings
	 */
	protected $settings;

	/**
	 * Stores the font family choices object.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    Choices
	 */
	protected $choices;

	/**
	 * Creates the component object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  Settings  $settings
	 * @param  Choices   $choices
	 * @return void
	 */
	public function __construct( Settings $settings, Choices $choices ) {

		$this->settings = $settings;
		$this->choices  = $choices;
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

		// Register default settings and choices.
		add_action( 'exhale/font/family/settings/register', [ $this, 'registerDefaultSettings' ] );
		add_action( 'exhale/font/family/choices/register',  [ $this, 'registerDefaultChoices'  ] );
	}

	/**
	 * Runs the register actions.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		do_action( 'exhale/font/family/settings/register', $this->settings );
		do_action( 'exhale/font/family/choices/register',  $this->choices  );
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
	 * Registers default choices.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  Choices  $settings
	 * @return void
	 */
	public function registerDefaultChoices( $choices ) {

		foreach ( Config::get( 'font-family-choices' ) as $name => $options ) {
			$choices->add( $name, $options );
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
				wp_strip_all_tags( $this->choices->get( $setting->mod() )->stack() )
			);
		}

		return sprintf( ':root { %s }', $css );
	}
}
