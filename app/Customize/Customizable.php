<?php
/**
 * Abstract customizable class.
 *
 * Base class for creating customizable components, which can be extended to
 * register customizer panels, sections, settings, controls, and partials.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Customize;

use Exhale\Tools\Collection;
use WP_Customize_Manager;

/**
 * Customizable class.
 *
 * @since  2.1.0
 *
 * @access public
 */
abstract class Customizable {

    /**
     * Sets up initial object properties.  If the data array passed in
     * contains a key that matches a property of the sub-class, its value
     * gets assigned to that property.
     *
     * @since  2.1.0
     * @param  array $data
     * @return void
     *
     * @access public
     */
    public function __construct( array $data = [] ) {

        foreach ( array_keys( get_object_vars( $this ) ) as $key ) {
            if ( isset( $data[ $key ] ) ) {
                $this->$key = $data[ $key ];
            }
        }
    }

    /**
     * Registers customizer panels.
     *
     * @since  2.1.0
     * @return void
     *
     * @access public
     */
    public function registerPanels( WP_Customize_Manager $manager ) {}

    /**
     * Registers customizer sections.
     *
     * @since  2.1.0
     * @return void
     *
     * @access public
     */
    public function registerSections( WP_Customize_Manager $manager ) {}

    /**
     * Registers customizer settings.
     *
     * @since  2.1.0
     * @return void
     *
     * @access public
     */
    public function registerSettings( WP_Customize_Manager $manager ) {}

    /**
     * Registers customizer controls.
     *
     * @since  2.1.0
     * @return void
     *
     * @access public
     */
    public function registerControls( WP_Customize_Manager $manager ) {}

    /**
     * Registers customizer partials.
     *
     * @since  2.1.0
     * @return void
     *
     * @access public
     */
    public function registerPartials( WP_Customize_Manager $manager ) {}

    /**
     * Registers JSON for the customize controls script via `wp_localize_script()`.
     * Objects added to the collection should implement the `JsonSerializable`
     * interface.
     *
     * @since  2.1.0
     * @return void
     *
     * @access public
     */
    public function controlsJson( Collection $json ) {}

    /**
     * Registers JSON for the customize preview script via `wp_localize_script()`.
     * Objects added to the collection should implement the `JsonSerializable`
     * interface.
     *
     * @since  2.1.0
     * @return void
     *
     * @access public
     */
    public function previewJson( Collection $json ) {}

}
