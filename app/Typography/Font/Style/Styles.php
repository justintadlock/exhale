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

namespace Exhale\Typography\Font\Style;

use Exhale\Tools\Collection;

/**
 * Font styles class.
 *
 * @since  2.0.0
 * @access public
 */
class Styles extends Collection {

	/**
	 * Adds a new font style to the collection.
	 *
	 * @since  2.0.0
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
	 * @since  2.0.0
	 * @access public
	 * @param  array  $styles  Limit choices to specific styles.
	 * @return array
	 */
	public function customizeChoices( array $styles = [] ) {

		$choices = [];

		foreach ( $this->all() as $style ) {

			if ( ! $styles || in_array( $style->name(), $styles ) ) {
				$choices[ $style->name() ] = $style->label();
			}
		}

		return $choices;
	}
}
