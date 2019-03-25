<?php
/**
 * Editor Colors Collection.
 *
 * Houses the collection of editor colors in a single array-object.
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
 * Editor colors class.
 *
 * @since  1.0.0
 * @access public
 */
class EditorColors extends Collection {

	/**
	 * Adds a new color color to the collection.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @param  array   $value
	 * @return void
	 */
	public function add( $name, $value ) {
		parent::add( $name, new EditorColor( $name, $value ) );
	}

	/**
	 * Returns an array of colors ready for the editor color palette
	 * `add_theme_support()` call.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function palette() {

		$palette = [];

		foreach ( $this->sort( $this->all() ) as $color ) {
			$palette[] = [
				'name'  => $color->label(),
				'slug'  => $color->name(),
				'color' => $color->hex()
			];
		}

		return $palette;
	}

	/**
	 * Sorts the colors from darkest to lightest.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array  $colors
	 * @return array
	 */
	public function sort( array $colors = [] ) {

		$colors = $colors ?: $this->all();

		usort( $colors, function( $a, $b ) {
			$_a = $a->rgb();
			$_b = $b->rgb();

			if ( ( $_a['r'] + $_a['g'] + $_a['b'] ) > ( $_b['r'] + $_b['g'] + $_b['b'] ) ) {
				return 1;
			}

			return -1;
		} );

		return $colors;
	}
}
