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
	 * Creates the component object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  Families  $families
	 * @return void
	 */
	public function __construct( Families $families ) {
		$this->families = $families;
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

		// Register default families.
		add_action( 'exhale/font/family/register', [ $this, 'registerDefaultFamilies' ] );
	}

	/**
	 * Runs the register actions.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		// Hook for registering custom fonts.
		do_action( 'exhale/font/family/register',  $this->families );
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
}
