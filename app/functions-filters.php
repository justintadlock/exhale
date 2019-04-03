<?php
/**
 * Theme filters and actions.
 *
 * Adds and defines custom filters and actions the theme adds to core WordPress.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale;

use Exhale\Settings\Options;
use Exhale\Tools\Config;
use Exhale\Tools\Svg;
use Exhale\Template\ErrorPage;

add_filter( 'hybrid/view/content/data', function( $data ) {

	if ( is_404() ) {
		$data->add( 'error', new ErrorPage() );
	}

	return $data;

} );

add_filter( 'display_post_states', function( $states, $post ) {

	if ( 'page' === $post->post_type && $post->ID === absint( Options::get( 'error_page' ) ) ) {
		$states['exhale_error_404'] = __( '404 Page', 'exhale' );
	}

	return $states;

}, 10, 2 );

add_filter( 'walker_nav_menu_start_el', __NAMESPACE__ . '\nav_menu_social_icons', 10, 4 );

add_filter( 'excerpt_length', function() {
	return 20;
} );

add_filter( 'excerpt_more', function() {

	return sprintf(
		'&thinsp;&hellip;&thinsp;<a href="%s" class="entry__more-link">%s</a>',
		esc_url( get_permalink() ),
		sprintf(
			// Translators: %s is the post title for screen readers.
			__( 'Continue reading&nbsp;%s&nbsp;&rarr;', 'exhale' ),
			the_title( '<span class="screen-reader-text">', '</span>', false )
		)
	);
} );

/**
 * Adds social icon SVGs to the social menu.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $item_output
 * @param  object  $item
 * @param  int     $depth
 * @param  array   $args
 * @return string
 */
function nav_menu_social_icons( $item_output, $item, $depth, $args ) {

	if ( 'social' === $args->theme_location ) {

		foreach ( Config::get( 'social-icons' ) as $url => $icon ) {

			if ( false !== strpos( $item->url, $url ) ) {
				$item_output = str_replace(
					$args->link_before,
					Svg::render( $icon ) . $args->link_before,
					$item_output
				);
			}
		}
	}

	return $item_output;
}
