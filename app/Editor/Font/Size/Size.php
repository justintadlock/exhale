<?php
/**
 * Font Size.
 *
 * Creates an font size object.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Editor\Font\Size;

/**
 * Font size class.
 *
 * @since  2.0.0
 *
 * @access public
 */
class Size {

    /**
     * Font size name.
     *
     * @since  2.0.0
     * @var    string
     *
     * @access protected
     */
    protected $name;

    /**
     * Font size label.
     *
     * @since  2.0.0
     * @var    string
     *
     * @access protected
     */
    protected $label;

    /**
     * Font size width.
     *
     * @since  2.0.0
     * @var    int
     *
     * @access protected
     */
    protected $size = 16;

    /**
     * Set up the object properties.
     *
     * @since  2.0.0
     * @param  string $name
     * @param  array  $options
     * @return void
     *
     * @access public
     */
    public function __construct( $name, array $options ) {

        foreach ( array_keys( get_object_vars( $this ) ) as $key ) {
            if ( isset( $options[ $key ] ) ) {
                $this->$key = $options[ $key ];
            }
        }

        $this->name = $name;
    }

    /**
     * Returns the font size name.
     *
     * @since  2.0.0
     * @return string
     *
     * @access public
     */
    public function name() {
        return $this->name;
    }

    /**
     * Returns the font size label.
     *
     * @since  2.0.0
     * @return string
     *
     * @access public
     */
    public function label() {

        return apply_filters(
            "exhale/editor/font/size/{$this->name}/label",
            $this->label ?: $this->name(),
            $this
        );
    }

    /**
     * Returns the font size width.
     *
     * @since  2.0.0
     * @return int
     *
     * @access public
     */
    public function size() {
        return absint( $this->size );
    }

}
