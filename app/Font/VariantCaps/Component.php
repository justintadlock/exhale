<?php
/**
 * Font Variant Caps Component.
 *
 * Manages the font variant caps component.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Font\VariantCaps;

use WP_Customize_Manager;

use Hybrid\Contracts\Bootable;
use Exhale\Tools\Config;

/**
 * Font variant caps component class.
 *
 * @since  1.3.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Stores the font variant caps object.
	 *
	 * @since  1.3.0
	 * @access protected
	 * @var    Caps
	 */
	protected $caps;

	/**
	 * Creates the component object.
	 *
	 * @since  1.3.0
	 * @access public
	 * @param  Caps   $caps
	 * @return void
	 */
	public function __construct( Caps $caps ) {
		$this->caps = $caps;
	}

	/**
	 * Bootstraps the component.
	 *
	 * @since  1.3.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		// Run registration on `after_setup_theme`.
		add_action( 'after_setup_theme', [ $this, 'register' ] );

		// Register default variant caps.
		add_action( 'exhale/font/variant/caps/register', [ $this, 'registerDefaultCaps' ] );
	}

	/**
	 * Runs the register actions.
	 *
	 * @since  1.3.0
	 * @access public
	 * @return void
	 */
	public function register() {

		// Hook for registering custom fonts.
		do_action( 'exhale/font/variant/caps/register', $this->caps );
	}

	/**
	 * Registers default variant caps.
	 *
	 * @since  1.3.0
	 * @access public
	 * @param  Caps   $caps
	 * @return void
	 */
	public function registerDefaultCaps( $caps ) {

		foreach ( Config::get( 'font-variant-caps' ) as $name => $options ) {
			$caps->add( $name, $options );
		}
	}
}
