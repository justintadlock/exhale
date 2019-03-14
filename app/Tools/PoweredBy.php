<?php
/**
 * Powered By Text Class.
 *
 * A simple class for randomly displaying a "powered by..." line of text in the
 * theme footer.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
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

		return apply_filters( 'exhale/power/collection', [
			__( 'Powered by heart and soul.' ),
			__( 'Powered by crazy ideas and passion.' ),
			__( 'Powered by the thing that holds all things together in the universe.' ),
			__( 'Powered by love.' ),
			__( 'Powered by the vast and endless void.' ),
			__( 'Powered by the code of a maniac.' ),
			__( 'Powered by peace and understanding.' ),
			__( 'Powered by coffee.' ),
			__( 'Powered by sleepness nights.' ),
			__( 'Powered by the love of all things.' ),
			__( 'Powered by something greater than myself.' )
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

		$powered_by = get_theme_mod( 'powered_by', true );

		if ( $powered_by ) {
			$collection = static::all();

			return $collection[ array_rand( $collection, 1 ) ];
		} else {
			return get_theme_mod( 'footer_credit' );
		}
	}
}
