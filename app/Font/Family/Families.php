<?php
/**
 * Font Families Collection.
 *
 * Houses the collection of font families in a single array-object.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Font\Family;

use Exhale\Tools\Collection;

/**
 * Font families class.
 *
 * @since  1.0.0
 * @access public
 */
class Families extends Collection {

	/**
	 * Adds a new font family to the collection.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @param  array   $value
	 * @return void
	 */
	public function add( $name, $value ) {
		parent::add( $name, new Family( $name, $value ) );
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

		$choices = [];

		foreach ( $this->all() as $family ) {
			$choices[ esc_attr( $family->name() ) ] = esc_html( $family->label() );
		}

		return $choices;
	}
}
