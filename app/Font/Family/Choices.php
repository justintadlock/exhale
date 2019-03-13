<?php
/**
 * Font Family Choices Collection.
 *
 * Houses the collection of font family choices in a single array-object.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Font\Family;

use Exhale\Tools\Collection;

/**
 * Font family choices class.
 *
 * @since  1.0.0
 * @access public
 */
class Choices extends Collection {

	/**
	 * Adds a new font family choice to the collection.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @param  array   $value
	 * @return void
	 */
	public function add( $name, $value ) {
		parent::add( $name, new Choice( $name, $value ) );
	}

	/**
	 * Returns an array of choices in key/value format for use with customize
	 * controls with the `choices` argument.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function customizeChoices() {

		$customize = [];

		foreach ( $this->all() as $choice ) {
			$customize[ esc_attr( $choice->name() ) ] = esc_html( $choice->label() );
		}

		return $customize;
	}
}
