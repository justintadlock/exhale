<?php
/**
 * SVG class.
 *
 * A simple class for returning or outputting an SVG file.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Tools;

/**
 * SVG class.
 *
 * @since  1.0.0
 * @access public
 */
class Svg {

	/**
	 * Returns the SVG file contents.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @return string
	 */
	public static function render( $name ) {

		$svg = file_get_contents( get_theme_file_path( static::path() . "/{$name}.svg" ) );

		return $svg ?: '';
	}

	/**
	 * Displays the SVG.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @return void
	 */
	public static function display( $name ) {
		echo static::render( $name );
	}

	/**
	 * Returns the path to the SVG folder.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	protected static function path() {
		return 'public/svg';
	}
}
