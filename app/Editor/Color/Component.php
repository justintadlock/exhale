<?php
/**
 * Color component.
 *
 * Handles the theme color feature.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Editor\Color;

use Exhale\Tools\Config;
use Exhale\Tools\CustomProperties;
use Hybrid\Contracts\Bootable;

/**
 * Color component class.
 *
 * @since  2.0.0
 *
 * @access public
 */
class Component implements Bootable {

    /**
     * Editor colors.
     *
     * @since  2.0.0
     * @var    \Exhale\Editor\Color\Colors
     *
     * @access protected
     */
    protected $colors;

    /**
     * Stores non-editor colors to print on the front end.
     *
     * @since  2.2.0
     * @var    \Exhale\Editor\Color\Colors
     *
     * @access protected
     */
    private $app_colors;

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
     * Creates the component object.
     *
     * @since  2.0.0
     * @param  \Exhale\Editor\Color\Colors $editor
     * @return void
     *
     * @access public
     */
    public function __construct( Colors $colors, CustomProperties $properties ) {
        $this->colors     = $colors;
        $this->properties = $properties;

        $this->app_colors = new Colors();
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

        // Register colors.
        add_action( 'exhale/editor/color/register', [ $this, 'registerDefaultColors' ] );
    }

    /**
     * Runs the register action and adds theme support.
     *
     * @since  2.0.0
     * @return void
     *
     * @access public
     */
    public function register() {

        // Hook for registering custom colors.
        do_action( 'exhale/editor/color/register', $this->colors );

        // Adds a color palette to the block editor.
        add_theme_support( 'editor-color-palette', $this->colors->palette() );

        // Adds each color as a custom property.
        foreach ( $this->colors as $color ) {

            if ( ! $color->isThemeMod() ) {
                $this->properties->add( 'editor-color-' . $color->name(), $color );
            }
        }

        // Adds each front-end-only color as a custom property.
        foreach ( $this->app_colors as $color ) {

            if ( ! $color->isThemeMod() ) {
                $this->properties->add( 'app-color-' . $color->name(), $color );
            }
        }
    }

    /**
     * Registers default editor colors.
     *
     * @since  2.0.0
     * @return void
     *
     * @access public
     */
    public function registerDefaultColors( Colors $colors ) {

        $base = Config::get( '_editor-colors' );

        foreach ( Config::get( 'editor-colors' ) as $name => $options ) {

            $name = $this->mapColor( $name );

            if ( isset( $base[ $name ] ) ) {
                $options = array_merge( $base[ $name ], $options );
            }

            $colors->add( $name, $options );
        }

        // Store non-editor colors to print on front end.
        foreach ( $base as $name => $options ) {
            if ( ! $colors->has( $name ) ) {
                $this->app_colors->add( $name, $options );
            }
        }
    }

    /**
     * Maps an old color name to the new style.
     *
     * @since  2.2.0
     * @param  string $color
     * @return string
     *
     * @access private
     */
    private function mapColor( $color ) {

        $map = [
            'blue'            => 'blue-500',
            'blue-dark'       => 'blue-600',
            'blue-darker'     => 'blue-700',
            'blue-darkest'    => 'blue-900',
            'blue-light'      => 'blue-400',
            'blue-lighter'    => 'blue-300',
            'blue-lightest'   => 'blue-100',
            'gray'            => 'gray-500',
            'gray-dark'       => 'gray-600',
            'gray-darker'     => 'gray-700',
            'gray-darkest'    => 'gray-900',
            'gray-light'      => 'gray-400',
            'gray-lighter'    => 'gray-300',
            'gray-lightest'   => 'gray-100',
            'green'           => 'green-500',
            'green-dark'      => 'green-600',
            'green-darker'    => 'green-700',
            'green-darkest'   => 'green-900',
            'green-light'     => 'green-400',
            'green-lighter'   => 'green-300',
            'green-lightest'  => 'green-100',
            'indigo'          => 'indigo-500',
            'indigo-dark'     => 'indigo-600',
            'indigo-darker'   => 'indigo-700',
            'indigo-darkest'  => 'indigo-900',
            'indigo-light'    => 'indigo-400',
            'indigo-lighter'  => 'indigo-300',
            'indigo-lightest' => 'indigo-100',
            'orange'          => 'orange-500',
            'orange-dark'     => 'orange-600',
            'orange-darker'   => 'orange-700',
            'orange-darkest'  => 'orange-900',
            'orange-light'    => 'orange-400',
            'orange-lighter'  => 'orange-300',
            'orange-lightest' => 'orange-100',
            'pink'            => 'pink-500',
            'pink-dark'       => 'pink-600',
            'pink-darker'     => 'pink-700',
            'pink-darkest'    => 'pink-900',
            'pink-light'      => 'pink-400',
            'pink-lighter'    => 'pink-300',
            'pink-lightest'   => 'pink-100',
            'purple'          => 'purple-500',
            'purple-dark'     => 'purple-600',
            'purple-darker'   => 'purple-700',
            'purple-darkest'  => 'purple-900',
            'purple-light'    => 'purple-400',
            'purple-lighter'  => 'purple-300',
            'purple-lightest' => 'purple-100',
            'red'             => 'red-500',
            'red-dark'        => 'red-600',
            'red-darker'      => 'red-700',
            'red-darkest'     => 'red-900',
            'red-light'       => 'red-400',
            'red-lighter'     => 'red-300',
            'red-lightest'    => 'red-100',
            'teal'            => 'teal-500',
            'teal-dark'       => 'teal-600',
            'teal-darker'     => 'teal-700',
            'teal-darkest'    => 'teal-900',
            'teal-light'      => 'teal-400',
            'teal-lighter'    => 'teal-300',
            'teal-lightest'   => 'teal-100',
            'yellow'          => 'yellow-500',
            'yellow-dark'     => 'yellow-600',
            'yellow-darker'   => 'yellow-700',
            'yellow-darkest'  => 'yellow-900',
            'yellow-light'    => 'yellow-400',
            'yellow-lighter'  => 'yellow-300',
            'yellow-lightest' => 'yellow-100',
        ];

        return $map[ $color ] ?? $color;
    }

}
