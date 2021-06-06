<?php
/**
 * Helper functions.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale;

use Hybrid\App;
use WP_Theme_JSON_Resolver_Gutenberg as ThemeJsonResolver;

/**
 * Helper function for outputting an asset URL in the theme. This integrates
 * with Laravel Mix for handling cache busting. If used when you enqueue a script
 * or style, it'll append an ID to the filename.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $path  A relative path/file to append to the `public` folder.
 * @return string
 */
function asset( $path ) {

	// Get the Laravel Mix manifest.
	$manifest = App::resolve( 'exhale/mix' );

	// Make sure to trim any slashes from the front of the path.
	$path = '/' . ltrim( $path, '/' );

	if ( $manifest && isset( $manifest[ $path ] ) ) {
		$path = $manifest[ $path ];
	}

	return get_theme_file_uri( 'public' . $path );
}


function fonts_url() {
	$url = '';

	if ( ! class_exists( ThemeJsonResolver::class ) ) {
		return $url;
	}

	$data = ThemeJsonResolver::get_merged_data()->get_settings();

	if ( empty( $data ) || empty( $data['custom'] || ! isset( $data['custom']['googleFonts'] ) ) ) {
		return $url;
	}

	$url = ! $data['custom']['googleFonts'] ?: esc_url_raw( sprintf(
		'https://fonts.googleapis.com/css2?%s',
		implode( '&', (array) $data['custom']['googleFonts'] )
	) );

	return $url;
}
