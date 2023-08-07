<?php
/**
 * Background customize class.
 *
 * Adds customizer elements for the background component.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Background;

use Exhale\Customize\Controls\BackgroundPosition;
use Exhale\Customize\Controls\BackgroundSvg;
use Exhale\Customize\Customizable;
use Exhale\Tools\Collection;
use Exhale\Tools\Mod;
use WP_Customize_Color_Control;
use WP_Customize_Image_Control;
use WP_Customize_Manager;

/**
 * Background customize class.
 *
 * @since  2.2.0
 *
 * @access public
 */
class Customize extends Customizable {

    /**
     * Houses the collection of patterns.
     *
     * @since  2.2.0
     * @var    \Exhale\Background\Pattern\Patterns
     *
     * @access protected
     */
    protected $patterns;

    /**
     * Registers customizer settings.
     *
     * @since  2.2.0
     * @return void
     *
     * @access public
     */
    public function registerSettings( WP_Customize_Manager $manager ) {

        array_map( static function( $section ) use ( $manager ) {

            $manager->add_setting( "{$section}_background_type", [
                'default'           => Mod::fallback( "{$section}_background_type" ),
                'sanitize_callback' => static fn( $value ) => in_array( $value, [ 'image', 'svg' ] ) ? $value : '',
                'transport'         => 'postMessage',
            ] );

            $manager->add_setting( "color_{$section}_background_fill", [
                'default'              => maybe_hash_hex_color( Mod::fallback( "color_{$section}_background_fill" ) ),
                'sanitize_callback'    => 'sanitize_hex_color_no_hash',
                'sanitize_js_callback' => 'maybe_hash_hex_color',
                'transport'            => 'postMessage',
            ] );

            $manager->add_setting( "{$section}_background_fill_opacity", [
                'default'           => Mod::fallback( "{$section}_background_fill_opacity" ),
                'sanitize_callback' => 'sanitize_text_field',
                'transport'         => 'postMessage',
            ] );

            $manager->add_setting( "{$section}_background_svg", [
                'default'           => Mod::fallback( "{$section}_background_svg" ),
                'sanitize_callback' => 'sanitize_key',
                'transport'         => 'postMessage',
            ] );

            $manager->add_setting( "{$section}_background_image", [
                'default'       => Mod::fallback( "{$section}_background_image" ),
                // 'sanitize_callback'    => 'esc_url_raw',
                    'transport' => 'postMessage',
            ] );

            $manager->add_setting( "{$section}_background_attachment", [
                'default'           => Mod::fallback( "{$section}_background_attachment" ),
                'sanitize_callback' => static function( $value ) {

                    $attachments = [
                        'scroll',
                        'fixed',
                        'local',
                    ];

                    return in_array( $value, $attachments ) ? $value : 'scroll';
                },
                'transport'         => 'postMessage',
            ] );

            $manager->add_setting( "{$section}_background_position", [
                'default'           => Mod::fallback( "{$section}_background_position" ),
                'sanitize_callback' => static function( $value ) {

                    $positions = [
                        'bottom',
                        'center',
                        'left',
                        'left-bottom',
                        'left-top',
                        'right',
                        'right-bottom',
                        'right-top',
                        'top',
                    ];

                    return in_array( $value, $positions ) ? $value : 'top';
                },
                'transport'         => 'postMessage',
            ] );

            $manager->add_setting( "{$section}_background_size", [
                'default'           => Mod::fallback( "{$section}_background_size" ),
                'sanitize_callback' => static function( $value ) {

                    $sizes = [
                        'auto',
                        'cover',
                        'container',
                    ];

                    return in_array( $value, $sizes ) ? $value : 'auto';
                },
                'transport'         => 'postMessage',
            ] );

            $manager->add_setting( "{$section}_background_repeat", [
                'default'           => Mod::fallback( "{$section}_background_repeat" ),
                'sanitize_callback' => static function( $value ) {

                    $repeats = [
                        'no-repeat',
                        'repeat',
                        'repeat-x',
                        'repeat-y',
                    ];

                    return in_array( $value, $repeats ) ? $value : 'top';
                },
                'transport'         => 'postMessage',
            ] );
        }, [ 'body', 'header', 'content', 'footer', 'sidebar_footer' ] );
    }

    /**
     * Registers customizer controls.
     *
     * @since  2.2.0
     * @return void
     *
     * @access public
     */
    public function registerControls( WP_Customize_Manager $manager ) {

        array_map( function( $section ) use ( $manager ) {

            $manager->add_control( "{$section}_background_type", [
                'choices'  => [
                    ''      => __( 'None', 'exhale' ),
                    'image' => __( 'Image', 'exhale' ),
                    'svg'   => __( 'Pattern', 'exhale' ),
                ],
                'label'    => __( 'Background Type', 'exhale' ),
                'priority' => 25,
                'section'  => "theme_{$section}_background",
                'type'     => 'select',
            ] );

            $manager->add_control(
                new WP_Customize_Color_Control( $manager, "color_{$section}_background_fill", [
                    'active_callback' => static fn() => 'svg' === Mod::get( "{$section}_background_type" ),
                    'label'           => __( 'Foreground Color', 'exhale' ),
                    'priority'        => 25,
                    'section'         => "theme_{$section}_background",
                ] )
            );

            $manager->add_control( "{$section}_background_fill_opacity", [
                'active_callback' => static fn() => 'svg' === Mod::get( "{$section}_background_type" ),
                'input_attrs'     => [
                    'max'  => '1',
                    'min'  => '0.1',
                    'step' => '0.1',
                ],
                'label'           => __( 'Foreground Opacity', 'exhale' ),
                'priority'        => 25,
                'section'         => "theme_{$section}_background",
                'type'            => 'number',
            ] );

            $choices = [];

            foreach ( $this->patterns as $pattern ) {
                $choices[ $pattern->name() ] = [
                    'cssValue' => $pattern->cssValue(
                        maybe_hash_hex_color( Mod::get( "color_{$section}_background_fill" ) ),
                        Mod::get( "{$section}_background_fill_opacity" )
                    ),
                    'label'    => $pattern->label(),
                ];
            }

            $manager->add_control(
                new BackgroundSvg( $manager, "{$section}_background_svg", [
                    'active_callback' => static fn() => 'svg' === Mod::get( "{$section}_background_type" ),
                    'background'      => Mod::color( "{$section}-background" ),
                    'choices'         => $choices,
                    'label'           => __( 'Background Pattern', 'exhale' ),
                    'priority'        => 25,
                    'section'         => "theme_{$section}_background",
                ] )
            );

            $manager->add_control(
                new WP_Customize_Image_Control( $manager, "{$section}_background_image", [
                    'active_callback' => static fn() => 'image' === Mod::get( "{$section}_background_type" ),
                    'label'           => __( 'Background Image', 'exhale' ),
                    'priority'        => 25,
                    'section'         => "theme_{$section}_background",
                ] )
            );

            $manager->add_control( "{$section}_background_attachment", [
                'active_callback' => static fn() => ( 'svg' === Mod::get( "{$section}_background_type" ) && Mod::get( "{$section}_background_svg" ) ) ||
                            ( 'image' === Mod::get( "{$section}_background_type" ) && Mod::get( "{$section}_background_image" ) ),
                'choices'         => [
                    'fixed'      => __( 'Fixed', 'exhale' ),
                    // 'local'     => __( 'Local',  'exhale' )
                        'scroll' => __( 'Scroll', 'exhale' ),
                ],
                'label'           => __( 'Background Attachment', 'exhale' ),
                'priority'        => 30,
                'section'         => "theme_{$section}_background",
                'type'            => 'select',
            ] );

            $manager->add_control( "{$section}_background_size", [
                'active_callback' => static fn() => ( 'svg' === Mod::get( "{$section}_background_type" ) && Mod::get( "{$section}_background_svg" ) ) ||
                            ( 'image' === Mod::get( "{$section}_background_type" ) && Mod::get( "{$section}_background_image" ) ),
                'choices'         => [
                    'auto'    => __( 'Auto', 'exhale' ),
                    'contain' => __( 'Contain', 'exhale' ),
                    'cover'   => __( 'Cover', 'exhale' ),
                ],
                'label'           => __( 'Background Size', 'exhale' ),
                'priority'        => 30,
                'section'         => "theme_{$section}_background",
                'type'            => 'select',
            ] );

            $manager->add_control( "{$section}_background_repeat", [
                'active_callback' => static fn() => ( 'svg' === Mod::get( "{$section}_background_type" ) && Mod::get( "{$section}_background_svg" ) ) ||
                            ( 'image' === Mod::get( "{$section}_background_type" ) && Mod::get( "{$section}_background_image" ) ),
                'choices'         => [
                    'no-repeat' => __( 'No Repeat', 'exhale' ),
                    'repeat'    => __( 'Repeat', 'exhale' ),
                    'repeat-x'  => __( 'Repeat Horizontally', 'exhale' ),
                    'repeat-y'  => __( 'Repeat Vertically', 'exhale' ),
                ],
                'label'           => __( 'Background Repeat', 'exhale' ),
                'priority'        => 30,
                'section'         => "theme_{$section}_background",
                'type'            => 'select',
            ] );

            $manager->add_control(
                new BackgroundPosition( $manager, "{$section}_background_position", [
                    'active_callback' => static fn() => ( 'svg' === Mod::get( "{$section}_background_type" ) && Mod::get( "{$section}_background_svg" ) ) ||
                                ( 'image' === Mod::get( "{$section}_background_type" ) && Mod::get( "{$section}_background_image" ) ),
                    'background'      => Mod::get( "{$section}_background_position" ),
                    'label'           => __( 'Background Position', 'exhale' ),
                    'priority'        => 30,
                    'section'         => "theme_{$section}_background",
                ] )
            );
        }, [ 'body', 'header', 'content', 'footer', 'sidebar_footer' ] );
    }

    /**
     * Registers JSON for the customize controls script via `wp_localize_script()`.
     *
     * @since  2.2.0
     * @return void
     *
     * @access public
     */
    public function controlsJson( Collection $json ) {

        $json->add( 'backgroundPatterns', $this->patterns );
    }

    /**
     * Registers JSON for the customize preview script via `wp_localize_script()`.
     *
     * @since  2.2.0
     * @return void
     *
     * @access public
     */
    public function previewJson( Collection $json ) {

        $json->add( 'backgroundPatterns', $this->patterns );
    }

}
