<?php
/**
 * Image Filter.
 *
 * Creates an image filter object.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Image\Filter;

use JsonSerializable;

/**
 * Image filter class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class Filter implements JsonSerializable {

    /**
     * Image filter name.
     *
     * @since  1.0.0
     * @var    string
     *
     * @access protected
     */
    protected $name;

    /**
     * Image filter label.
     *
     * @since  1.0.0
     * @var    string
     *
     * @access protected
     */
    protected $label;

    /**
     * Image filter width.
     *
     * @since  1.0.0
     * @var    int
     *
     * @access protected
     */
    protected $min = 0;

    /**
     * Image filter height.
     *
     * @since  1.0.0
     * @var    string
     *
     * @access protected
     */
    protected $max = 100;

    /**
     * Whether to crop the image to exact width and height.
     *
     * @since  1.0.0
     * @var    bool
     *
     * @access protected
     */
    protected $lacuna = 0;

    /**
     * Set up the object properties.
     *
     * @since  1.0.0
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
     * Returns the image filters in a format necessary for JSON serialization.
     *
     * @since  1.0.0
     * @return array
     *
     * @access public
     */
    public function jsonSerialize() {

        return [
            'lacuna' => $this->lacuna(),
            'max'    => $this->max(),
            'min'    => $this->min(),
        ];
    }

    /**
     * Returns the image filter name.
     *
     * @since  1.0.0
     * @return string
     *
     * @access public
     */
    public function name() {
        return $this->name;
    }

    /**
     * Returns the image filter label.
     *
     * @since  1.0.0
     * @return string
     *
     * @access public
     */
    public function label() {

        return apply_filters(
            "exhale/image/filter/{$this->name}/label",
            $this->label ?: $this->name(),
            $this
        );
    }

    /**
     * Returns the image filter width.
     *
     * @since  1.0.0
     * @return int
     *
     * @access public
     */
    public function min() {
        return absint( $this->min );
    }

    /**
     * Returns the image filter height.
     *
     * @since  1.0.0
     * @return int
     *
     * @access public
     */
    public function max() {
        return absint( $this->max );
    }

    /**
     * Returns whether to hard-crop the image.
     *
     * @since  1.0.0
     * @return bool
     *
     * @access public
     */
    public function lacuna() {
        return absint( $this->lacuna );
    }

}
