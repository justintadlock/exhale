<?php
/**
 * Color Settings Collection.
 *
 * Houses the collection of color settings in a single array-object.
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
 * Color settings class.
 *
 * @since  1.0.0
 * @access public
 */
class Settings extends Collection {

	/**
	 * Adds a new color setting to the collection.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @param  array   $value
	 * @return void
	 */
	public function add( $name, $value ) {
		parent::add( $name, new Setting( $name, $value ) );
	}

	/**
	 * Returns an array of editor color settings ready for the editor color
	 * palette `add_theme_support()` call.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function editorPalette() {

		$palette = [];

		foreach ( $this->editorColors() as $setting ) {
			$palette[] = [
				'name'  => $setting->label(),
				'slug'  => $setting->name(),
				'color' => $setting->hex()
			];
		}

		return $palette;
	}

	/**
	 * Returns an array of editor color settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function editorColors() {

		$colors = [];

		foreach ( $this->all() as $color ) {
			if ( $color->isEditorColor() ) {
				$colors[] = $color;
			}
		}

		return $this->sort( $colors );
	}

	/**
	 * Returns an array of customize color settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function customizeColors() {

		$colors = [];

		foreach ( $this->all() as $color ) {
			if ( $color->isCustomizerColor() ) {
				$colors[] = $color;
			}
		}

		return $colors;
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
