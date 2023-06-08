<?php
/**
 * Layout Component.
 *
 * Manages the layout component.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Layout\Loop;

use WP_Customize_Manager;

use Hybrid\App;
use Hybrid\Contracts\Bootable;
use Exhale\Tools\Config;
use Exhale\Tools\Mod;
use Exhale\Template\FeaturedImage;

/**
 * Layout component class.
 *
 * @since  2.1.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Stores the layouts object.
	 *
	 * @since  2.1.0
	 * @access protected
	 * @var    Layouts
	 */
	protected $layouts;

	/**
	 * Creates the component object.
	 *
	 * @since  2.1.0
	 * @access public
	 * @param  Layouts  $global
	 * @param  Layouts  $loop
	 * @return void
	 */
	public function __construct( Layouts $layouts ) {
		$this->layouts = $layouts;
	}

	/**
	 * Bootstraps the component.
	 *
	 * @since  2.1.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		// Run registration on `after_setup_theme`.
		add_action( 'after_setup_theme', [ $this, 'register' ] );

		// Register default layouts.
		add_action( 'exhale/layout/loop/register', [ $this, 'registerDefaultLayouts' ] );
	}

	/**
	 * Runs the register actions.
	 *
	 * @since  2.1.0
	 * @access public
	 * @return void
	 */
	public function register() {

		// Hook for registering custom layouts.
		do_action( 'exhale/layout/loop/register', $this->layouts );
	}

	/**
	 * Registers default loop layouts.
	 *
	 * @since  2.1.0
	 * @access public
	 * @param  Layouts  $layouts
	 * @return void
	 */
	public function registerDefaultLayouts( $layouts ) {

		foreach ( Config::get( 'layouts-loop' ) as $name => $options ) {
			$layouts->add( $name, new Layout( $name, $options ) );
		}
	}
}
