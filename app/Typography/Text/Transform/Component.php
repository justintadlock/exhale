<?php
/**
 * Text Transform Component.
 *
 * Manages the text transform component.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Typography\Text\Transform;

use Exhale\Tools\Config;
use Hybrid\Contracts\Bootable;

/**
 * Text transform component class.
 *
 * @since  2.0.0
 *
 * @access public
 */
class Component implements Bootable {

    /**
     * Stores the text transforms object.
     *
     * @since  2.0.0
     * @var    \Exhale\Typography\Text\Transform\Transforms
     *
     * @access protected
     */
    protected $transforms;

    /**
     * Creates the component object.
     *
     * @since  2.0.0
     * @return void
     *
     * @access public
     */
    public function __construct( Transforms $transforms ) {
        $this->transforms = $transforms;
    }

    /**
     * Bootstraps the component.
     *
     * @since  2.0.0
     * @return void
     *
     * @access public
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
     * @return void
     *
     * @access public
     */
    public function register() {

        // Hook for registering custom fonts.
        do_action( 'exhale/typography/text/transform/register', $this->transforms );
    }

    /**
     * Registers default transforms.
     *
     * @since  2.0.0
     * @param  \Exhale\Typography\Text\Transform\Transforms $transforms
     * @return void
     *
     * @access public
     */
    public function registerDefaultTransforms( $transforms ) {

        foreach ( Config::get( 'text-transforms' ) as $name => $options ) {
            $transforms->add( $name, $options );
        }
    }

}
