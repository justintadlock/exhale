<?php
/**
 * Font Variant Cap.
 *
 * Creates a font variant cap object.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Typography\Font\VariantCaps;

use JsonSerializable;

/**
 * Font variant cap class.
 *
 * @since  2.0.0
 *
 * @access public
 */
class Cap implements JsonSerializable {

    /**
     * Setting name.
     *
     * @since  2.0.0
     * @var    string
     *
     * @access protected
     */
    protected $name;

    /**
     * Setting label.
     *
     * @since  2.0.0
     * @var    string
     *
     * @access protected
     */
    protected $label;

    /**
     * Font variant cap.
     *
     * @since  2.0.0
     * @var    string
     *
     * @access protected
     */
    protected $cap;

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
     * @since  2.0.0
     * @return array
     *
     * @access public
     */
    public function jsonSerialize() {

        return [
            'cap'   => $this->cap(),
            'label' => $this->label(),
            'name'  => $this->name(),
        ];
    }

    /**
     * Returns the choice name.
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
     * Returns the choice label.
     *
     * @since  2.0.0
     * @return string
     *
     * @access public
     */
    public function label() {
        return $this->label ?: $this->name();
    }

    /**
     * Returns the font variant cap.
     *
     * @since  2.0.0
     * @return string
     *
     * @access public
     */
    public function cap() {
        return $this->cap ?: $this->name();
    }

}
