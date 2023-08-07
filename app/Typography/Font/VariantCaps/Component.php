<?php
/**
 * Font Variant Caps Component.
 *
 * Manages the font variant caps component.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Typography\Font\VariantCaps;

use Exhale\Tools\Config;
use Hybrid\Contracts\Bootable;

/**
 * Font variant caps component class.
 *
 * @since  2.0.0
 *
 * @access public
 */
class Component implements Bootable {

    /**
     * Stores the font variant caps object.
     *
     * @since  2.0.0
     * @var    \Exhale\Typography\Font\VariantCaps\Caps
     *
     * @access protected
     */
    protected $caps;

    /**
     * Creates the component object.
     *
     * @since  2.0.0
     * @return void
     *
     * @access public
     */
    public function __construct( Caps $caps ) {
        $this->caps = $caps;
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

        // Register default variant caps.
        add_action( 'exhale/typography/font/variant/caps/register', [ $this, 'registerDefaultCaps' ] );
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
        do_action( 'exhale/typography/font/variant/caps/register', $this->caps );
    }

    /**
     * Registers default variant caps.
     *
     * @since  2.0.0
     * @param  \Exhale\Typography\Font\VariantCaps\Caps $caps
     * @return void
     *
     * @access public
     */
    public function registerDefaultCaps( $caps ) {

        foreach ( Config::get( 'font-variant-caps' ) as $name => $options ) {
            $caps->add( $name, $options );
        }
    }

}
