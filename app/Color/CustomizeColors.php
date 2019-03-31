<?php
/**
 * Customize Colors Collection.
 *
 * Houses the collection of customize colors in a single array-object.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Color;

use Exhale\Tools\Collection;

/**
 * Customize colors class.
 *
 * @since  1.0.0
 * @access public
 */
class CustomizeColors extends Collection {

	/**
	 * Adds a new customize color to the collection.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @param  array   $value
	 * @return void
	 */
	public function add( $name, $value ) {
		parent::add( $name, new CustomizeColor( $name, $value ) );
	}
}
