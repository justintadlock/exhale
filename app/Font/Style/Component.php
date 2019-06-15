<?php
/**
 * Font Style Component.
 *
 * Manages the font style component.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Font\Style;

use WP_Customize_Manager;

use Hybrid\Contracts\Bootable;
use Exhale\Tools\Config;

/**
 * Font component class.
 *
 * @since  1.3.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Stores the font styles object.
	 *
	 * @since  1.3.0
	 * @access protected
	 * @var    Styles
	 */
	protected $styles;

	/**
	 * Creates the component object.
	 *
	 * @since  1.3.0
	 * @access public
	 * @param  Styles  $styles
	 * @return void
	 */
	public function __construct( Styles $styles ) {
		$this->styles = $styles;
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

		// Register default styles.
		add_action( 'exhale/font/style/register', [ $this, 'registerDefaultStyles' ] );
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
		do_action( 'exhale/font/style/register',  $this->styles );
	}

	/**
	 * Registers default styles.
	 *
	 * @since  1.3.0
	 * @access public
	 * @param  Styles  $styles
	 * @return void
	 */
	public function registerDefaultStyles( $styles ) {

		foreach ( Config::get( 'font-styles' ) as $name => $options ) {
			$styles->add( $name, $options );
		}
	}
}
