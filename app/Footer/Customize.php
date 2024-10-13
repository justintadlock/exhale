<?php
/**
 * Footer customize class.
 *
 * Adds customizer elements for the footer component.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Footer;

use Exhale\Customize\Customizable;
use Exhale\Template\Footer as TemplateFooter;
use Exhale\Tools\Mod;
use WP_Customize_Manager;

/**
 * Footer customize class.
 *
 * @since  2.1.0
 *
 * @access public
 */
class Customize extends Customizable {

    /**
     * Registers customizer settings.
     *
     * @since  2.1.0
     * @return void
     *
     * @access public
     */
    public function registerSettings( WP_Customize_Manager $manager ) {

        // Register sidebar footer settings.
        $manager->add_setting( 'sidebar_footer_width', [
            'default'           => Mod::fallback( 'sidebar_footer_width' ),
            'sanitize_callback' => 'sanitize_key',
            'transport'         => 'postMessage',
        ] );

        // Register footer settings.
        $manager->add_setting( 'powered_by', [
            'default'           => Mod::fallback( 'powered_by' ),
            'sanitize_callback' => 'wp_validate_boolean',
            'transport'         => 'postMessage',
        ] );

        $manager->add_setting( 'footer_credit', [
            // Translators: %s is the theme link.
            'default'           => Mod::fallback( 'footer_credit' ),
            'sanitize_callback' => static fn( $value ) => wp_kses( $value, TemplateFooter::allowedTags() ),
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

        // Sidebar width control.
        $manager->add_control( 'sidebar_footer_width', [
            'choices' => [
                '2xl'  => __( 'Medium', 'exhale' ),
                '3xl'  => __( 'Large', 'exhale' ),
                '4xl'  => __( 'Extra Large', 'exhale' ),
                '5xl'  => __( 'Huge', 'exhale' ),
                '6xl'  => __( 'Gargantuan', 'exhale' ),
                '7xl'  => __( 'Titanic', 'exhale' ),
                'full' => __( 'Full', 'exhale' ),
            ],
            'label'   => __( 'Footer Sidebar: Width', 'exhale' ),
            'section' => 'theme_footer_sidebar',
            'type'    => 'select',
        ] );

        // Powered by control.
        $manager->add_control( 'powered_by', [
            'label'   => __( 'Show random "powered by" credit text.', 'exhale' ),
            'section' => 'theme_footer_credit',
            'type'    => 'checkbox',
        ] );

        // Footer credit control.
        $manager->add_control( 'footer_credit', [
            'active_callback' => static fn( $control ) => ! $control->manager->get_setting( 'powered_by' )->value(),
            'label'           => __( 'Custom Footer Text', 'exhale' ),
            'section'         => 'theme_footer_credit',
            'type'            => 'textarea',
        ] );
    }

    /**
     * Registers customizer partials.
     *
     * @since  2.1.0
     * @return void
     *
     * @access public
     */
    public function registerPartials( WP_Customize_Manager $manager ) {

        // Footer credit partial.
        $manager->selective_refresh->add_partial( 'powered_by', [
            'container_inclusive' => true,
            'render_callback'     => static fn() => TemplateFooter::renderCredit(),
            'selector'            => '.app-footer__credit',
            'settings'            => [ 'powered_by', 'footer_credit' ],
        ] );
    }

}
