<?php
/**
 * Layouts Collection.
 *
 * Houses the collection of layouts in a single array-object.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Layout;

use Exhale\Tools\Collection;

/**
 * Layouts class.
 *
 * @since  1.2.0
 * @access public
 */
class Layouts extends Collection {

	/**
	 * Adds a new layout to the collection.
	 *
	 * @since  1.2.0
	 * @access public
	 * @param  string  $name
	 * @param  array   $value
	 * @return void
	 */
	public function add( $name, $value ) {

		parent::add(
			$name,
		 	$value instanceof Layout ? $value : new Layout( $name, $value )
		);
	}

	/**
	 * Returns an array of the choices for the customizer control.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return array
	 */
	public function customizeChoices() {

		$choices = [];

		foreach ( $this->all() as $layout ) {
			$choices[ $layout->name() ] = $layout->label();
		}

		return $choices;
	}
}
