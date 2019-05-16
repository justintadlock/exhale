<?php
/**
 * Layouts Collection.
 *
 * Houses the collection of font layouts in a single array-object.
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
 * Font layouts class.
 *
 * @since  1.2.0
 * @access public
 */
class Layouts extends Collection {

	/**
	 * Adds a new font family to the collection.
	 *
	 * @since  1.2.0
	 * @access public
	 * @param  string  $name
	 * @param  array   $value
	 * @return void
	 */
	public function add( $name, $value ) {
		parent::add( $name, new Layout( $name, $value ) );
	}

	public function customizeChoices() {

		$choices = [];

		foreach ( $this->all() as $layout ) {
			$choices[ $layout->name() ] = $layout->label();
		}

		return $choices;
	}
}
