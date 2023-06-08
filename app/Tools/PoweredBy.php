<?php
/**
 * Powered By Text Class.
 *
 * A simple class for randomly displaying a "powered by..." line of text in the
 * theme footer.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Tools;

/**
 * Powered by class.
 *
 * @since  1.0.0
 * @access public
 */
class PoweredBy {

	/**
	 * Returns an array of all the powered by quotes.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public static function all() {

		return apply_filters( 'exhale/poweredby/collection', [
			__( 'Powered by heart and soul.', 'exhale' ),
			__( 'Powered by crazy ideas and passion.', 'exhale' ),
			__( 'Powered by the thing that holds all things together in the universe.', 'exhale' ),
			__( 'Powered by love.', 'exhale' ),
			__( 'Powered by the vast and endless void.', 'exhale' ),
			__( 'Powered by the code of a maniac.', 'exhale' ),
			__( 'Powered by peace and understanding.', 'exhale' ),
			__( 'Powered by coffee.', 'exhale' ),
			__( 'Powered by sleepness nights.', 'exhale' ),
			__( 'Powered by the love of all things.', 'exhale' ),
			__( 'Powered by something greater than myself.', 'exhale' )
		] );
	}

	/**
	 * Displays a random powered by quote.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public static function display() {
		echo esc_html( static::render() );
	}

	/**
	 * Returns a random powered by quote.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public static function render() {
		$collection = static::all();

		return $collection[ array_rand( $collection, 1 ) ];
	}
}
