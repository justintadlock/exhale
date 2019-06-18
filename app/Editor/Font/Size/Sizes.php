<?php
/**
 * Font Sizes Collection.
 *
 * Houses the collection of font sizes in a single array-object.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Editor\Font\Size;

use Hybrid\Tools\Collection;

/**
 * Font sizes class.
 *
 * @since  2.0.0
 * @access public
 */
class Sizes extends Collection {

	/**
	 * Adds a new font size to the collection.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $name
	 * @param  array   $value
	 * @return void
	 */
	public function add( $name, $value ) {
		parent::add( $name, new Size( $name, $value ) );
	}
}
