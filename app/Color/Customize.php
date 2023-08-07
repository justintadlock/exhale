<?php
/**
 * Color customize class.
 *
 * Adds customizer elements for the color component.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Color;

use Exhale\Customize\Customizable;
use Exhale\Tools\Collection;
use WP_Customize_Color_Control;
use WP_Customize_Manager;

/**
 * Color customize class.
 *
 * @since  2.1.0
 *
 * @access public
 */
class Customize extends Customizable {

    /**
     * Color settings object.
     *
     * @since  2.1.0
     * @var    \Exhale\Color\Setting\Settings
     *
     * @access protected
     */
    protected $settings;

    /**
     * Registers customizer settings.
     *
     * @since  2.1.0
     * @return void
     *
     * @access public
     */
    public function registerSettings( WP_Customize_Manager $manager ) {

        // Registers the color settings and controls.
        array_map( static function( $setting ) use ( $manager ) {

            $manager->add_setting( $setting->modName(), [
                'default'              => maybe_hash_hex_color( $setting->color() ),
                'sanitize_callback'    => 'sanitize_hex_color_no_hash',
                'sanitize_js_callback' => 'maybe_hash_hex_color',
                'transport'            => 'postMessage',
            ] );
        }, $this->settings->all() );
    }

    /**
     * Registers customizer controls.
     *
     * @since  2.1.0
     * @return void
     *
     * @access public
     */
    public function registerControls( WP_Customize_Manager $manager ) {

        // Registers the color settings and controls.
        array_map( static function( $setting ) use ( $manager ) {

            $manager->add_control(
                new WP_Customize_Color_Control( $manager, $setting->modName(), [
                    'description' => esc_html( $setting->description() ),
                    'label'       => esc_html( $setting->label() ),
                    'section'     => $setting->section(),
                ] )
            );
        }, $this->settings->all() );
    }

    /**
     * Registers JSON for the customize preview script via `wp_localize_script()`.
     *
     * @since  2.1.0
     * @return void
     *
     * @access public
     */
    public function previewJson( Collection $json ) {

        $json->add( 'colorSettings', $this->settings );
    }

}
