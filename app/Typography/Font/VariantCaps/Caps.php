<?php
/**
 * Font Variant Caps Collection.
 *
 * Houses the collection of font variant caps in a single array-object.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Typography\Font\VariantCaps;

use Exhale\Tools\Collection;

/**
 * Font variant caps class.
 *
 * @since  2.0.0
 * @access public
 */
class Caps extends Collection {

	/**
	 * Adds a new font variant cap to the collection.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $name
	 * @param  array   $value
	 * @return void
	 */
	public function add( $name, $value ) {
		parent::add( $name, new Cap( $name, $value ) );
	}

	/**
	 * Returns an array of choices in key/value format for use with customize
	 * controls with the `choices` argument.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return array
	 */
	public function customizeChoices() {

		$choices = [];

		foreach ( $this->all() as $cap ) {
			$choices[ $cap->name() ] = $cap->label();
		}

		return $choices;
	}
}
