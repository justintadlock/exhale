<?php
/**
 * Footer Class.
 *
 * A simple class for outputting the appropriate footer credit text.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Template;

use Exhale\Tools\PoweredBy;

/**
 * Powered by class.
 *
 * @since  1.0.0
 * @access public
 */
class Footer {

	/**
	 * Displays a random powered by quote.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public static function displayCredit() {
		echo static::renderCredit();
	}

	/**
	 * Returns a random powered by quote.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public static function renderCredit( array $args = [] ) {

		$args = wp_parse_args( $args, [
			'before' => '<p class="app-footer__credit">',
			'after'  => '</p>'
		] );

		$powered_by = get_theme_mod( 'powered_by', true );

		$text = $powered_by ? PoweredBy::render() : get_theme_mod( 'footer_credit' );

		return sprintf(
			'%s%s%s',
			$args['before'],
			wp_kses( $text, static::allowedTags() ),
			$args['after']
		);
	}

	/**
	 * Returns an array of allowed tags in footer text.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public static function allowedTags() {

		return [
			'a'       => [ 'href' => true, 'title' => true, 'class' => true ],
			'abbr'    => [ 'title' => true ],
			'acronym' => [ 'title' => true ],
			'bold'    => [ 'class' => true ],
			'code'    => [ 'class' => true ],
			'em'      => [ 'class' => true ],
			'i'       => [ 'class' => true ],
			'span'    => [ 'class' => true ],
			'strong'  => [ 'class' => true ]
		];
	}
}
