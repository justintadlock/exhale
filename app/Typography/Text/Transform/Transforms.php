<?php
/**
 * Text Transforms Collection.
 *
 * Houses the collection of text transforms in a single array-object.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Typography\Text\Transform;

use Exhale\Tools\Collection;

/**
 * Text transforms class.
 *
 * @since  2.0.0
 * @access public
 */
class Transforms extends Collection {

	/**
	 * Adds a new text transform to the collection.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $name
	 * @param  array   $value
	 * @return void
	 */
	public function add( $name, $value ) {
		parent::add( $name, new Transform( $name, $value ) );
	}

	/**
	 * Returns an array of choices in key/value format for use with customize
	 * controls with the `choices` argument.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  array  $transforms
	 * @return array
	 */
	public function customizeChoices( $transforms = [] ) {

		$choices = [];

		foreach ( $this->all() as $transform ) {

			if ( ! $transforms || in_array( $transform->name(), $transforms ) ) {
				$choices[ $transform->name() ] = $transform->label();
			}
		}

		return $choices;
	}
}
