<?php
/**
 * Typography customize class.
 *
 * Adds customizer elements for the typography component.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Typography;

use Exhale\Customize\Controls;
use Exhale\Customize\Customizable;
use Exhale\Tools\Collection;
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
     * Typography settings object.
     *
     * @since  2.1.0
     * @var    \Exhale\Typography\Setting\Settings
     *
     * @access protected
     */
    protected $settings;

    /**
     * Font families object.
     *
     * @since  2.1.0
     * @var    \Exhale\Typography\Font\Family\Families
     *
     * @access protected
     */
    protected $families;

    /**
     * Font styles object.
     *
     * @since  2.1.0
     * @var    \Exhale\Typography\Font\Family\Styles
     *
     * @access protected
     */
    protected $styles;

    /**
     * Font variant caps object.
     *
     * @since  2.1.0
     * @var    \Exhale\Typography\Font\VariantCaps\Caps
     *
     * @access protected
     */
    protected $caps;

    /**
     * Text transforms object.
     *
     * @since  2.1.0
     * @var    \Exhale\Typography\Text\Transform\Transforms
     *
     * @access protected
     */
    protected $transforms;

    /**
     * Registers customizer settings.
     *
     * @since  2.1.0
     * @return void
     *
     * @access public
     */
    public function registerSettings( WP_Customize_Manager $manager ) {

        // Registers the font settings and controls.
        array_map( static function( $setting ) use ( $manager ) {

            // Bail if the setting doesn't handle the font family.
            // In the future we'll allow this.
            if ( ! $setting->hasOption( 'family' ) ) {
                return;
            }

            // If the setting has the family option.
            if ( $setting->hasOption( 'family' ) ) {

                // Register the family setting.
                $manager->add_setting( $setting->modName( 'family' ), [
                    'default'           => $setting->family(),
                    'sanitize_callback' => 'sanitize_key',
                    'transport'         => 'postMessage',
                ] );
            }

            // If the setting has the style option.
            if ( $setting->hasOption( 'style' ) ) {

                // Register the family setting.
                $manager->add_setting( $setting->modName( 'style' ), [
                    'default'           => $setting->style(),
                    'sanitize_callback' => 'sanitize_key',
                    'transport'         => 'postMessage',
                ] );
            }

            // If the setting has the text-transform option.
            if ( $setting->hasOption( 'transform' ) ) {

                // Register the transform setting.
                $manager->add_setting( $setting->modName( 'transform' ), [
                    'default'           => $setting->transform(),
                    'sanitize_callback' => 'sanitize_key',
                    'transport'         => 'postMessage',
                ] );
            }

            // If the setting has the caps option.
            if ( $setting->hasOption( 'caps' ) ) {

                // Register the caps setting.
                $manager->add_setting( $setting->modName( 'caps' ), [
                    'default'           => $setting->caps(),
                    'sanitize_callback' => 'sanitize_key',
                    'transport'         => 'postMessage',
                ] );
            }
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

        // Registers the font controls.
        array_map( function( $setting ) use ( $manager ) {

            // Bail if the setting doesn't handle the font family.
            // In the future we'll allow this.
            if ( ! $setting->hasOption( 'family' ) ) {
                return;
            }

            // Set up the default control arguments.
            $control = [
                'caps'        => [],
                'description' => $setting->description(),
                'family'      => [],
                'label'       => $setting->label(),
                'section'     => 'theme_global_typography',
                'settings'    => [],
                'style'       => [],
                'transform'   => [],
            ];

            // If the setting has the family option.
            if ( $setting->hasOption( 'family' ) ) {

                // Add the family setting name to the control.
                $control['settings']['family'] = $setting->modName( 'family' );

                // Add the family choices to the control.
                $control['family']['choices'] = $this->families->customizeChoices(
                    $setting->requiredStyles()
                );
            }

            // If the setting has the style option.
            if ( $setting->hasOption( 'style' ) ) {

                // Add the style setting name to the control.
                $control['settings']['style'] = $setting->modName( 'style' );

                // Add the style choices to the control.
                $limit = $setting->hasOption( 'family' )
                    ? $this->families->get( $setting->mod() )->styles()
                    : [];

                $control['style']['choices'] = $this->styles->customizeChoices( $limit );
            }

            // If the setting has the text-transform option.
            if ( $setting->hasOption( 'transform' ) ) {

                // Add the transform setting name to the control.
                $control['settings']['transform'] = $setting->modName( 'transform' );

                // Add the transform choices to the control.
                $control['transform']['choices'] = $this->transforms->customizeChoices();
            }

            // If the setting has the caps option.
            if ( $setting->hasOption( 'caps' ) ) {

                // Add the caps setting name to the control.
                $control['settings']['caps'] = $setting->modName( 'caps' );

                // Add the caps choices to the control.
                $control['caps']['choices'] = $this->caps->customizeChoices();
            }

            // Register the font control.
            $manager->add_control( new Controls\Typography(
                $manager,
                sprintf( 'font_%s', $setting->name() ),
                $control
            ) );
        }, $this->settings->all() );
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

        $json->add( 'fontFamilies', $this->families );
        $json->add( 'fontStyles', $this->styles );
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

        $json->add( 'typographySettings', $this->settings );
        $json->add( 'fontFamilies', $this->families );
        $json->add( 'fontStyles', $this->styles );
        $json->add( 'fontVariantCaps', $this->caps );
        $json->add( 'textTransforms', $this->transforms );
    }

}
