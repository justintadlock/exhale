<?php
/**
 * Font Style Component.
 *
 * Manages the font style component.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Typography\Font\Style;

use Exhale\Tools\Config;
use Hybrid\Contracts\Bootable;

/**
 * Font component class.
 *
 * @since  2.0.0
 *
 * @access public
 */
class Component implements Bootable {

    /**
     * Stores the font styles object.
     *
     * @since  2.0.0
     * @var    \Exhale\Typography\Font\Style\Styles
     *
     * @access protected
     */
    protected $styles;

    /**
     * Creates the component object.
     *
     * @since  2.0.0
     * @return void
     *
     * @access public
     */
    public function __construct( Styles $styles ) {
        $this->styles = $styles;
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

        // Register default styles.
        add_action( 'exhale/typography/font/style/register', [ $this, 'registerDefaultStyles' ] );
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

        // Hook for registering custom styles.
        do_action( 'exhale/typography/font/style/register', $this->styles );
    }

    /**
     * Registers default styles.
     *
     * @since  2.0.0
     * @param  \Exhale\Typography\Font\Style\Styles $styles
     * @return void
     *
     * @access public
     */
    public function registerDefaultStyles( $styles ) {

        foreach ( Config::get( 'font-styles' ) as $name => $options ) {
            $styles->add( $name, $options );
        }
    }

}
