<?php
/**
 * Text Transform Component.
 *
 * Manages the text transform component.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Font\TextTransform;

use WP_Customize_Manager;

use Hybrid\Contracts\Bootable;
use Exhale\Tools\Config;

/**
 * Text transform component class.
 *
 * @since  1.3.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Stores the text transforms object.
	 *
	 * @since  1.3.0
	 * @access protected
	 * @var    Transforms
	 */
	protected $transforms;

	/**
	 * Creates the component object.
	 *
	 * @since  1.3.0
	 * @access public
	 * @param  Transforms  $transforms
	 * @return void
	 */
	public function __construct( Transforms $transforms ) {
		$this->transforms = $transforms;
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

		// Register default transforms.
		add_action( 'exhale/font/transform/register', [ $this, 'registerDefaultTransforms' ] );
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
		do_action( 'exhale/font/transform/register', $this->transforms );
	}

	/**
	 * Registers default transforms.
	 *
	 * @since  1.3.0
	 * @access public
	 * @param  Transforms  $transforms
	 * @return void
	 */
	public function registerDefaultTransforms( $transforms ) {

		foreach ( Config::get( 'text-transforms' ) as $name => $options ) {
			$transforms->add( $name, $options );
		}
	}
}
