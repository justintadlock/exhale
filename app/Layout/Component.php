<?php
/**
 * Layout Family Component.
 *
 * Manages the layout family component.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Layout;

use WP_Customize_Manager;

use Hybrid\Contracts\Bootable;
use Exhale\Tools\Config;
use Exhale\Tools\CustomProperties;

/**
 * Layout component class.
 *
 * @since  1.2.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Stores the layouts object.
	 *
	 * @since  1.2.0
	 * @access protected
	 * @var    Layouts
	 */
	protected $layouts;

	/**
	 * Creates the component object.
	 *
	 * @since  1.2.0
	 * @access public
	 * @param  Layouts  $layouts
	 * @return void
	 */
	public function __construct( Layouts $layouts ) {
		$this->layouts = $layouts;
	}

	/**
	 * Bootstraps the component.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		// Run registration on `after_setup_theme`.
		add_action( 'after_setup_theme', [ $this, 'register' ] );

		// Add customizer settings and controls.
		add_action( 'customize_register', [ $this, 'customizeRegister'] );

		add_filter( 'body_class', [ $this, 'bodyClass' ] );

		// Register default layouts.
		add_action( 'exhale/layout/register', [ $this, 'registerDefaultLayouts' ] );
	}

	/**
	 * Runs the register actions.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return void
	 */
	public function register() {

		// Hook for registering custom layouts.
		do_action( 'exhale/layout/register', $this->layouts );
	}

	/**
	 * Registers default layouts.
	 *
	 * @since  1.2.0
	 * @access public
	 * @param  Layouts  $layouts
	 * @return void
	 */
	public function registerDefaultLayouts( $layouts ) {

		foreach ( Config::get( 'layouts' ) as $name => $options ) {
			$layouts->add( $name, $options );
		}
	}

	/**
	 * Customize register callback.
	 *
	 * @since  1.2.0
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function customizeRegister( WP_Customize_Manager $manager ) {

		$manager->add_setting( 'layout', [
			'default'           => 'wide',
			'sanitize_callback' => 'sanitize_key',
	//		'transport'         => 'postMessage'
		] );

		$manager->add_control( 'layout', [
			'section' => 'layouts',
			'type'    => 'select',
			'label'   => __( 'Layout', 'exhale' ),
			'choices' => $this->layouts->customizeChoices()
		] );
	}

	public function bodyClass( $classes ) {

		$layout = get_theme_mod( 'layout', 'wide' );

		$classes[] = sanitize_html_class( "layout-{$layout}" );

		return $classes;
	}
}
