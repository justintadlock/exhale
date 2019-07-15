<?php
/**
 * Theme Mod Class.
 *
 * This class is a wrapper around the theme mod system for quickly getting mods.
 * It also provides helper methods for getting mods from specific features.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Tools;

use Closure;
use Hybrid\App;
use Exhale\Color\Setting\Settings as ColorSettings;

use function Hybrid\Theme\mod;

/**
 * Theme mod class.
 *
 * @since  1.0.0
 * @access public
 */
class Mod {

	/**
	 * Returns a theme mod value.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @param  mixed   $default
	 * @return mixed
	 */
	public static function get( $name, $default = '' ) {

		$fallback = static::fallback( $name );

		return mod(
			$name,
			! $default && ! is_null( $fallback ) ? $fallback : $default
		);
	}

	/**
	 * Returns a default theme mod.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $name
	 * @return mixed
	 */
	public static function fallback( $name ) {

		$mods = App::resolve( 'exhale/mods' );

		if ( isset( $mods[ $name ] ) ) {

			return $mods[ $name ] instanceof Closure
			       ? $mods[ $name ]->__invoke()
			       : $mods[ $name ];
		}

		return null;
	}

	/**
	 * Returns a color theme mod.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @param  mixed   $default
	 * @return mixed
	 */
	public static function color( $name, $default = '' ) {
		$colors = App::resolve( ColorSettings::class );

		return $colors->has( $name ) ? $colors->get( $name )->mod() : $default;
	}
}
