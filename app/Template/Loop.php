<?php
/**
 * Loop Template Class.
 *
 * A simple class for working with the loop template on the front end.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Template;

use Hybrid\App;
use Exhale\Tools\Mod;
use Exhale\Image\Size\Sizes as ImageSizes;

/**
 * Loop class.
 *
 * @since  2.1.0
 * @access public
 */
class Loop {

	/**
	 * Returns the current loop type if one is not provided.
	 *
	 * @since  2.1.0
	 * @access public
	 * @param  string  $type
	 * @return string
	 */
	public static function type( $type = '' ) {

		if ( $type ) {
			return $type;
		}

		return is_home() ? 'blog' : 'archive';
	}

	/**
	 * Returns the layout object for the loop.
	 *
	 * @since  2.1.0
	 * @access public
	 * @param  string  $type
	 * @return \Exhale\Layout\LoopLayout
	 */
	public static function layout( $type = '' ) {

		return App::resolve( 'layouts/loop' )->get(
			Mod::get( sprintf( 'loop_%s_layout', static::type( $type ) ) )
		);
	}

	/**
	 * Returns the image size object for the loop.
	 *
	 * @since  2.1.0
	 * @access public
	 * @param  string  $type
	 * @return \Exhale\Image\Size\Size
	 */
	public static function imageSize( $type = '' ) {

		return App::resolve( ImageSizes::class )->get(
			Mod::get( sprintf( 'loop_%s_image_size', static::type( $type ) ) )
		);
	}

	/**
	 * Returns the columns number for the loop.
	 *
	 * @since  2.1.0
	 * @access public
	 * @param  string  $type
	 * @return int
	 */
	public static function columns( $type = '' ) {

		return absint( Mod::get( sprintf( 'loop_%s_columns', static::type( $type ) ) ) );
	}

	/**
	 * Returns the layout width class for the loop.
	 *
	 * @since  2.1.0
	 * @access public
	 * @param  string  $type
	 * @return \Exhale\Layout\LoopLayout
	 */
	public static function width( $type = '' ) {

		return Mod::get( sprintf( 'loop_%s_width', static::type( $type ) ) );
	}
}
