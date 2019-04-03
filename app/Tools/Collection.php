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

use JsonSerializable;
use Hybrid\Tools\Collection as CollectionBase;

/**
 * Collection class.
 *
 * @since  1.0.0
 * @access public
 */
class Collection extends CollectionBase implements JsonSerializable {

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
