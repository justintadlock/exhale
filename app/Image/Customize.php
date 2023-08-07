<?php
/**
 * Image customize class.
 *
 * Adds customizer elements for the image component.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Image;

use Exhale\Customize\Controls;
use Exhale\Customize\Customizable;
use Exhale\Tools\Collection;
use Exhale\Tools\Mod;
use WP_Customize_Manager;

/**
 * Image customize class.
 *
 * @since  2.1.0
 *
 * @access public
 */
class Customize extends Customizable {

    /**
     * Image filters object.
     *
     * @since  2.1.0
     * @var    \Exhale\Image\Filter\Filters
     *
     * @access protected
     */
    protected $filters;

    /**
     * Registers customizer settings.
     *
     * @since  2.1.0
     * @return void
     *
     * @access public
     */
    public function registerSettings( WP_Customize_Manager $manager ) {

        // Image filter settings.
        $manager->add_setting( 'image_default_filter_function', [
            'default'           => 'grayscale',
            'sanitize_callback' => 'sanitize_key',
            'transport'         => 'postMessage',
        ] );

        $manager->add_setting( 'image_default_filter_amount', [
            'default'           => Mod::fallback( 'image_default_filter_amount' ),
            'sanitize_callback' => 'absint',
            'transport'         => 'postMessage',
        ] );

        $manager->add_setting( 'image_hover_filter_amount', [
            'default'           => Mod::fallback( 'image_hover_filter_amount' ),
            'sanitize_callback' => 'absint',
            'transport'         => 'postMessage',
        ] );
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

        // Image filter controls.
        $manager->add_control(
            new Controls\ImageFilter( $manager, 'image_filter', [
                'filters'  => $this->filters,
                'l10n'     => [
                    'default_amount' => [
                        'description' => __( 'Filter amount applied to all images.', 'exhale' ),
                        'label'       => __( 'Default Filter Amount', 'exhale' ),
                    ],
                    'function'       => [
                        'description' => __( 'CSS filter function to apply to images.', 'exhale' ),
                        'label'       => __( 'Image Filter', 'exhale' ),
                    ],
                    'hover_amount'   => [
                        'description' => __( 'Filter amount applied to linked images when they are hovered or focused.', 'exhale' ),
                        'label'       => __( 'Hover Filter  Amount', 'exhale' ),
                    ],
                ],
                'section'  => 'theme_global_media',
                'settings' => [
                    'default_amount' => 'image_default_filter_amount',
                    'function'       => 'image_default_filter_function',
                    'hover_amount'   => 'image_hover_filter_amount',
                ],
            ] )
        );
    }

    /**
     * Registers JSON for the customize controls script via `wp_localize_script()`.
     *
     * @since  2.1.0
     * @return void
     *
     * @access public
     */
    public function controlsJson( Collection $json ) {

        $json->add( 'imageFilters', $this->filters );
    }

}
