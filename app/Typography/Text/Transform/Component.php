<?php
/**
 * Text Transform Component.
 *
 * Manages the text transform component.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Typography\Text\Transform;

use WP_Customize_Manager;

use Hybrid\Contracts\Bootable;
use Exhale\Tools\Config;

/**
 * Text transform component class.
 *
 * @since  2.0.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Stores the text transforms object.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @var    Transforms
	 */
	protected $transforms;

	/**
	 * Creates the component object.
	 *
	 * @since  2.0.0
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
	 * @since  2.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		// Run registration on `after_setup_theme`.
		add_action( 'after_setup_theme', [ $this, 'register' ] );

		// Register default transforms.
		add_action( 'exhale/typography/text/transform/register', [ $this, 'registerDefaultTransforms' ] );
	}

	/**
	 * Runs the register actions.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		// Hook for registering custom fonts.
		do_action( 'exhale/typography/text/transform/register', $this->transforms );
	}

	/**
	 * Registers default transforms.
	 *
	 * @since  2.0.0
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
