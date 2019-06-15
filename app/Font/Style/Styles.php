<?php
/**
 * Font Styles Collection.
 *
 * Houses the collection of font styles in a single array-object.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Font\Style;

use Exhale\Tools\Collection;

/**
 * Font styles class.
 *
 * @since  1.3.0
 * @access public
 */
class Styles extends Collection {

	/**
	 * Adds a new font style to the collection.
	 *
	 * @since  1.3.0
	 * @access public
	 * @param  string  $name
	 * @param  array   $value
	 * @return void
	 */
	public function add( $name, $value ) {
		parent::add( $name, new Style( $name, $value ) );
	}

	/**
	 * Returns an array of choices in key/value format for use with customize
	 * controls with the `choices` argument.
	 *
	 * @since  1.3.0
	 * @access public
	 * @return array
	 */
	public function customizeChoices() {

		$choices = [];

		foreach ( $this->all() as $style ) {
			$choices[ $style->name() ] = $style->label();
		}

		return $choices;
	}
}
