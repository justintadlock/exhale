<?php
/**
 * Layout Component.
 *
 * Manages the layout component.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Layout\App;

use Exhale\Layout\Layout;
use Exhale\Layout\Layouts;
use Exhale\Tools\Config;
use Exhale\Tools\Mod;
use Hybrid\Contracts\Bootable;

/**
 * Layout component class.
 *
 * @since  2.1.0
 *
 * @access public
 */
class Component implements Bootable {

    /**
     * Stores the global layouts object.
     *
     * @since  2.1.0
     * @var    \Exhale\Layout\Layouts
     *
     * @access protected
     */
    protected $layouts;

    /**
     * Creates the component object.
     *
     * @since  2.1.0
     * @return void
     *
     * @access public
     */
    public function __construct( Layouts $layouts ) {
        $this->layouts = $layouts;
    }

    /**
     * Bootstraps the component.
     *
     * @since  2.1.0
     * @return void
     *
     * @access public
     */
    public function boot() {

        // Run registration on `after_setup_theme`.
        add_action( 'after_setup_theme', [ $this, 'register' ] );

        // Adds a layout body class on the front end.
        add_filter( 'body_class', [ $this, 'bodyClass' ] );

        // Register default layouts.
        add_action( 'exhale/layout/global/register', [ $this, 'registerDefaultLayouts' ] );
    }

    /**
     * Runs the register actions.
     *
     * @since  2.1.0
     * @return void
     *
     * @access public
     */
    public function register() {

        // Hook for registering custom layouts.
        do_action( 'exhale/layout/global/register', $this->layouts );
    }

    /**
     * Registers default global layouts.
     *
     * @since  2.1.0
     * @param  \Exhale\Layout\Layouts $layouts
     * @return void
     *
     * @access public
     */
    public function registerDefaultLayouts( $layouts ) {

        foreach ( Config::get( 'layouts' ) as $name => $options ) {
            $layouts->add( $name, new Layout( $name, $options ) );
        }
    }

    /**
     * Filter on the body class on the front end that adds our layout class.
     *
     * @since  2.1.0
     * @param  array $classes
     * @return array
     *
     * @access public
     */
    public function bodyClass( $classes ) {

        $classes[] = sanitize_html_class(
            sprintf( 'layout-%s', Mod::get( 'layout' ) )
        );

        return $classes;
    }

}
