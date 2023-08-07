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

namespace Exhale\Layout\Loop;

use Exhale\Tools\Config;
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
     * Stores the layouts object.
     *
     * @since  2.1.0
     * @var    \Exhale\Layout\Loop\Layouts
     *
     * @access protected
     */
    protected $layouts;

    /**
     * Creates the component object.
     *
     * @since  2.1.0
     * @param  \Exhale\Layout\Loop\Layouts $global
     * @param  \Exhale\Layout\Loop\Layouts $loop
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

        // Register default layouts.
        add_action( 'exhale/layout/loop/register', [ $this, 'registerDefaultLayouts' ] );
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
        do_action( 'exhale/layout/loop/register', $this->layouts );
    }

    /**
     * Registers default loop layouts.
     *
     * @since  2.1.0
     * @param  \Exhale\Layout\Loop\Layouts $layouts
     * @return void
     *
     * @access public
     */
    public function registerDefaultLayouts( $layouts ) {

        foreach ( Config::get( 'layouts-loop' ) as $name => $options ) {
            $layouts->add( $name, new Layout( $name, $options ) );
        }
    }

}
