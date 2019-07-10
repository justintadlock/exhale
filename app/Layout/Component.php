<?php
/**
 * Layout Component.
 *
 * Manages the layout component.
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
use Exhale\Tools\Mod;

/**
 * Layout component class.
 *
 * @since  1.2.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Stores the global layouts object.
	 *
	 * @since  2.1.0
	 * @access protected
	 * @var    Layouts
	 */
	protected $global;

	/**
	 * Stores the loop layouts object.
	 *
	 * @since  2.1.0
	 * @access protected
	 * @var    Layouts
	 */
	protected $loop;

	/**
	 * Creates the component object.
	 *
	 * @since  1.2.0
	 * @access public
	 * @param  Layouts  $global
	 * @param  Layouts  $loop
	 * @return void
	 */
	public function __construct( Layouts $global, Layouts $loop ) {
		$this->global = $global;
		$this->loop   = $loop;
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

		// Adds a layout body class on the front end.
		add_filter( 'body_class', [ $this, 'bodyClass' ] );

		// Register default layouts.
		add_action( 'exhale/layout/global/register', [ $this, 'registerDefaultGlobalLayouts' ] );
		add_action( 'exhale/layout/loop/register',   [ $this, 'registerDefaultLoopLayouts'   ] );
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
		do_action( 'exhale/layout/global/register', $this->global );
		do_action( 'exhale/layout/loop/register',   $this->loop   );
	}

	/**
	 * Registers default global layouts.
	 *
	 * @since  2.1.0
	 * @access public
	 * @param  Layouts  $layouts
	 * @return void
	 */
	public function registerDefaultGlobalLayouts( $layouts ) {

		foreach ( Config::get( 'layouts' ) as $name => $options ) {
			$layouts->add( $name, new Layout( $name, $options ) );
		}
	}

	/**
	 * Registers default loop layouts.
	 *
	 * @since  2.1.0
	 * @access public
	 * @param  Layouts  $layouts
	 * @return void
	 */
	public function registerDefaultLoopLayouts( $layouts ) {

		foreach ( Config::get( 'layouts-loop' ) as $name => $options ) {
			$layouts->add( $name, new LayoutLoop( $name, $options ) );
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

		$manager->add_section( 'layout', [
			'panel'    => 'theme_options',
			'title'    => __( 'Layout', 'exhale' ),
			'priority' => 5
		] );

		$manager->add_setting( 'layout', [
			'default'           => Mod::fallback( 'layout' ),
			'sanitize_callback' => 'sanitize_key',
			'transport'         => 'postMessage'
		] );

		$manager->add_control( 'layout', [
			'section'     => 'layout',
			'type'        => 'select',
			'label'       => __( 'Global Layout', 'exhale' ),
			'description' => __( 'Select the layout used across the site.', 'exhale' ),
			'choices'     => $this->global->customizeChoices()
		] );
	}

	/**
	 * Filter on the body class on the front end that adds our layout class.
	 *
	 * @since  1.2.0
	 * @access public
	 * @param  array  $classes
	 * @return array
	 */
	public function bodyClass( $classes ) {

		$classes[] = sanitize_html_class(
			sprintf( 'layout-%s', Mod::get( 'layout' ) )
		);

		return $classes;
	}
}
