<?php
/**
 * Font Family Component.
 *
 * Manages the font family component.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Typography\Font\Family;

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
     * Stores the font families object.
     *
     * @since  2.0.0
     * @var    \Exhale\Typography\Font\Family\Families
     *
     * @access protected
     */
    protected $families;

    /**
     * Creates the component object.
     *
     * @since  2.0.0
     * @return void
     *
     * @access public
     */
    public function __construct( Families $families ) {
        $this->families = $families;
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

        // Register default families.
        add_action( 'exhale/typography/font/family/register', [ $this, 'registerDefaultFamilies' ] );
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
        do_action( 'exhale/typography/font/family/register', $this->families );

        // Back-compat hook for pre-2.0.0.
        do_action( 'exhale/font/family/register', $this->families );
    }

    /**
     * Registers default families.
     *
     * @since  2.0.0
     * @param  \Exhale\Typography\Font\Family\Families $families
     * @return void
     *
     * @access public
     */
    public function registerDefaultFamilies( $families ) {

        foreach ( Config::get( 'font-families' ) as $name => $options ) {
            $families->add( $name, $options );
        }
    }

}
