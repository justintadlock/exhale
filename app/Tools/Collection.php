<?php
/**
 * Collection Class.
 *
 * An extension of the Hybrid Core `Collection` class that implements the
 * `JsonSerializable` interface.  Note that this class will be removed in the
 * future if/when this gets added to the framework.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Tools;

use ArrayObject;
use JsonSerializable;

/**
 * Registry class.
 *
 * @since  1.0.0
 * @access public
 */
class Collection extends ArrayObject implements JsonSerializable {

    /**
     * Add an item.
     *
     * @since  1.0.0
     * @access public
     * @param  string  $name
     * @param  mixed   $value
     * @return void
     */
    public function add( $name, $value ) {
        $this->offsetSet( $name, $value );
    }

    /**
     * Removes an item.
     *
     * @since  1.0.0
     * @access public
     * @param  string  $name
     * @return void
     */
    public function remove( $name ) {
        $this->offsetUnset( $name );
    }

    /**
     * Checks if an item exists.
     *
     * @since  1.0.0
     * @access public
     * @param  string  $name
     * @return bool
     */
    public function has( $name ) {
        return $this->offsetExists( $name );
    }

    /**
     * Returns an item.
     *
     * @since  1.0.0
     * @access public
     * @param  string  $name
     * @return mixed
     */
    public function get( $name ) {
        return $this->offsetGet( $name );
    }

    /**
     * Returns the collection of items.
     *
     * @since  1.0.0
     * @access public
     * @return array
     */
    public function all() {
        return $this->getArrayCopy();
    }

    /**
     * Magic method when trying to set a property. Assume the property is
     * part of the collection and add it.
     *
     * @since  1.0.0
     * @access public
     * @param  string  $name
     * @param  mixed   $value
     * @return void
     */
    public function __set( $name, $value ) {
        $this->offsetSet( $name, $value );
    }

    /**
     * Magic method when trying to unset a property.
     *
     * @since  1.0.0
     * @access public
     * @param  string  $name
     * @return void
     */
    public function __unset( $name ) {
        $this->offsetUnset( $name );
    }

    /**
     * Magic method when trying to check if a property has.
     *
     * @since  1.0.0
     * @access public
     * @param  string  $name
     * @return bool
     */
    public function __isset( $name ) {
        return $this->offsetExists( $name );
    }

    /**
     * Magic method when trying to get a property.
     *
     * @since  1.0.0
     * @access public
     * @param  string  $name
     * @return mixed
     */
    public function __get( $name ) {
        return $this->offSetGet( $name );
    }

    /**
     * Returns a JSON-ready array of data.
     *
     * @since  1.0.0
     * @access public
     * @return array
     */
    public function jsonSerialize() {

        return array_map( function( $value ) {

            if ( $value instanceof JsonSerializable ) {
                return $value->jsonSerialize();
            }

            return $value;

        }, $this->all() );
    }
}
