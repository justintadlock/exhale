<?php
/**
 * Font Setting Component.
 *
 * Manages the font setting component.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Typography\Setting;

use Exhale\Tools\Config;
use Exhale\Tools\CustomProperties;
use Hybrid\Contracts\Bootable;
use WP_Customize_Manager;
use function Hybrid\Font\enqueue as enqueue_font;

/**
 * Font setting component class.
 *
 * @since  2.0.0
 *
 * @access public
 */
class Component implements Bootable {

    /**
     * Stores the font settings object.
     *
     * @since  2.0.0
     * @var    \Exhale\Typography\Setting\Settings
     *
     * @access protected
     */
    protected $settings;

    /**
     * CSS custom properties.
     *
     * @since  2.0.0
     * @var    \Exhale\Tools\CustomProperties
     *
     * @access protected
     */
    protected $properties;

    /**
     * Stores the array of collections.
     *
     * @since  2.0.0
     * @var    array
     *
     * @access protected
     */
    protected $collections;

    /**
     * Stores the font families object.
     *
     * @since  2.0.0
     * @var    \Exhale\Typography\Setting\Families
     *
     * @access protected
     */
    protected $families;

    /**
     * Stores the font styles object.
     *
     * @since  2.0.0
     * @var    \Exhale\Typography\Setting\Families
     *
     * @access protected
     */
    protected $styles;

    /**
     * Stores the font variant caps object.
     *
     * @since  2.0.0
     * @var    \Exhale\Typography\Setting\Caps
     *
     * @access protected
     */
    protected $caps;

    /**
     * Stores the text transforms object.
     *
     * @since  2.0.0
     * @var    \Exhale\Typography\Setting\Transforms
     *
     * @access protected
     */
    protected $transforms;

    /**
     * Creates the component object.
     *
     * @since  2.0.0
     * @param  \Exhale\Typography\Setting\Settings $settings
     * @param  \Exhale\Tools\CustomProperties      $settings
     * @param  array                               $collections
     * @return void
     *
     * @access public
     */
    public function __construct( Settings $settings, CustomProperties $properties, array $collections = [] ) {

        foreach ( array_keys( get_object_vars( $this ) ) as $key ) {
            if ( isset( $collections[ $key ] ) ) {
                $this->$key = $collections[ $key ];
            }
        }

        $this->settings    = $settings;
        $this->properties  = $properties;
        $this->collections = $collections;
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

        // Register default settings.
        add_action( 'exhale/typography/setting/register', [ $this, 'registerDefaultSettings' ] );

        // Add customizer settings and controls.
        // add_action( 'customize_register', [ $this, 'customizeRegister'] );

        // Enqueue fonts.
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue' ], 5 );
        add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue' ], 5 );
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

        // Hook for registering settings.
        do_action( 'exhale/typography/setting/register', $this->settings );

        // Adds each font setting as a custom property.
        foreach ( $this->settings as $setting ) {
            $this->properties->add( 'typography-' . $setting->name(), $setting );
        }
    }

    /**
     * Registers default settings.
     *
     * @since  2.0.0
     * @return void
     *
     * @access public
     */
    public function registerDefaultSettings( Settings $settings ) {

        // Base configuration.
        $base   = Config::get( '_settings-typography' );
        $config = [];

        // Back-compat with child themes that registered a config of
        // `config/settings-font-family.php` pre-2.0.
        if ( is_child_theme() ) {
            $config = Config::get( 'settings-font-family' );
        }

        $config = $config ?: Config::get( 'settings-typography' );

        $config = is_array( $config ) ? $config : [];

        foreach ( $base as $name => $options ) {

            if ( isset( $config[ $name ] ) ) {
                $options = array_merge( $options, $config[ $name ] );
            }

            $value = [
                'collections' => $this->collections,
                'options'     => $options,
            ];

            $settings->add( $name, $value );
        }
    }

    /**
     * Enqueues any scripts/styles necessary for font settings.
     *
     * @since  2.0.0
     * @return void
     *
     * @access public
     */
    public function enqueue() {
        $fonts = $this->googleFonts();

        if ( $fonts ) {
            enqueue_font( 'exhale', [
                'family' => $fonts,
                'subset' => [
                    'latin',
                    'latin-ext',
                ],
            ] );
        }
    }

    /**
     * Returns an array of Google fonts to load.
     *
     * @since  2.0.0
     * @return array
     *
     * @access protected
     */
    protected function googleFonts() {
        $fonts = [];

        foreach ( $this->settings as $setting ) {

            $family = $this->families->get( $setting->mod() );

            $font_styles = [ '400', '400i', '700', '700i' ];

            if ( is_customize_preview() ) {

                $font_styles = $family->styles();

            } elseif ( $setting->hasOption( 'style' ) ) {

                $style = $this->styles->get( $setting->mod( 'style' ) );

                $font_styles = [
                    $style->normal(),
                    $style->italic(),
                ];

                foreach ( $style->bolds() as $bold ) {

                    if ( in_array( $bold, $family->styles() ) ) {
                        $font_styles[] = $bold;
                        break;
                    }
                }

                foreach ( $style->boldItalics() as $b_italic ) {

                    if ( in_array( $b_italic, $family->styles() ) ) {
                        $font_styles[] = $b_italic;
                        break;
                    }
                }

                $font_styles = array_unique( $font_styles );
            }

            if ( $family->isGoogleFont() && ! isset( $fonts[ $family->name() ] ) ) {
                $fonts[ $family->name() ] = sprintf(
                    '%s:%s',
                    $family->googleName(),
                    join( ',', $font_styles )
                );
            }
        }

        return $fonts;
    }

    /**
     * Customize register callback.
     *
     * @since  2.0.0
     * @return void
     *
     * @access public
     */
    public function customizeRegister( WP_Customize_Manager $manager ) {
    }

}
