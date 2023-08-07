<?php
/**
 * SVG class.
 *
 * A simple class for returning or outputting an SVG file.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Tools;

/**
 * SVG class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class Svg {

    /**
     * Returns the SVG file contents.
     *
     * @since  1.0.0
     * @param  string $name
     * @return string
     *
     * @access public
     */
    public static function render( $name ) {

        $svg = file_get_contents( static::path( "{$name}.svg" ) );

        return apply_filters( "exhale/svg/{$name}", $svg ?: '' );
    }

    /**
     * Displays the SVG.
     *
     * @since  1.0.0
     * @param  string $name
     * @return void
     *
     * @access public
     */
    public static function display( $name ) {
        echo static::render( $name );
    }

    /**
     * Returns the path to the SVG folder or file if set.
     *
     * @since  1.0.0
     * @return string
     *
     * @access public
     */
    public static function path( $file = '' ) {

        $file = trim( $file, '/' );

        return get_theme_file_path( $file ? "public/svg/{$file}" : 'public/svg' );
    }

}
