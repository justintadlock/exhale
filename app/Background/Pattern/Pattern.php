<?php
/**
 * Pattern.
 *
 * Creates a pattern object.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Background\Pattern;

use JsonSerializable;

/**
 * Pattern class.
 *
 * @since  2.2.0
 *
 * @access public
 */
class Pattern implements JsonSerializable {

    /**
     * Pattern name.
     *
     * @since  2.2.0
     * @var    string
     *
     * @access protected
     */
    protected $name;

    /**
     * Pattern label.
     *
     * @since  2.2.0
     * @var    string
     *
     * @access protected
     */
    protected $label;

    /**
     * SVG HTML.
     *
     * @since  2.2.0
     * @var    string
     *
     * @access protected
     */
    protected $svg;

    /**
     * Set up the object properties.
     *
     * @since  2.2.0
     * @param  string $name
     * @param  array  $options
     * @return void
     *
     * @access public
     */
    public function __construct( $name, array $options = [] ) {

        foreach ( array_keys( get_object_vars( $this ) ) as $key ) {
            if ( isset( $options[ $key ] ) ) {
                $this->$key = $options[ $key ];
            }
        }

        $this->name = $name;
    }

    /**
     * Returns a JSON-ready array of only the properties we'll need for use
     * in the customize-preview JS.
     *
     * @since  2.2.0
     * @return array
     *
     * @access public
     */
    public function jsonSerialize() {

        return [
            'name' => $this->name(),
            'svg'  => $this->svg(),
        ];
    }

    /**
     * Returns the pattern name.
     *
     * @since  2.2.0
     * @return string
     *
     * @access public
     */
    public function name() {
        return $this->name;
    }

    /**
     * Returns the pattern label.
     *
     * @since  2.2.0
     * @return string
     *
     * @access public
     */
    public function label() {
        return $this->label;
    }

    /**
     * Returns the SVG HTML.
     *
     * @since  2.2.0
     * @param  string $fill
     * @param  string $opacity
     * @return string
     *
     * @access public
     */
    public function svg( $fill = '#000', $opacity = '1.0' ) {

        return preg_replace(
            '/fill=([\'"])#.+?([\'"])/i',
            'fill=${1}' . $fill . '${2} fill-opacity=${1}' . + $opacity . '${2}',
            $this->svg
        );
    }

    /**
     * Returns the SVG as a CSS background image value.
     *
     * @since  2.2.0
     * @param  string $fill
     * @param  string $opacity
     * @return string
     *
     * @access public
     */
    public function cssValue( $fill = '#000', $opacity = '1.0' ) {

        $svg = $this->svg( $fill, $opacity );

        $svg = str_replace( [ "\n", "\t", "\r" ], '', $svg );

        $svg = preg_replace(
            [ '~<~', '~>~', '~#~', '~"~', '~&~' ],
            [ '%3C', '%3E', '%23', '\'', '%26' ],
            $svg
        );

        return sprintf( 'url( "data:image/svg+xml, %s" )', $svg );
    }

}
