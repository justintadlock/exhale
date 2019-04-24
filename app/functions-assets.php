<?php
/**
 * Asset-related functions and filters.
 *
 * This file holds some setup actions for scripts and styles as well as a helper
 * functions for work with assets.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale;

use Hybrid\App;
use Exhale\Tools\CustomProperties;
use Exhale\Settings\Options;

/**
 * Enqueue scripts/styles for the front end.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'wp_enqueue_scripts', function() {

	// Disable core block styles.
	wp_dequeue_style( 'wp-block-library' );

	// Load WordPress' comment-reply script where appropriate.
	if ( is_singular() && get_option( 'thread_comments' ) && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Enqueue theme scripts.
	wp_enqueue_script( 'exhale-app', asset( 'js/app.js' ), null, null, true );

	// Enqueue theme styles.
	wp_enqueue_style(
		'exhale-screen',
		asset( Options::get( 'classic_style' ) ? 'css/screen-classic.css' : 'css/screen.css' ),
		null,
		null
	);

	wp_add_inline_style( 'exhale-screen', App::resolve( CustomProperties::class )->css() );

} );

/**
 * Enqueue scripts/styles for the editor.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'enqueue_block_editor_assets', function() {

	$deps = [
		'wp-i18n',
		'wp-blocks',
		'wp-dom-ready',
		'wp-edit-post',
	];

	wp_enqueue_script( 'exhale-editor', asset( 'js/editor.js' ), $deps, null, true );

	// For now, we're adding translations via PHP. In the future, when our
	// tools catch up, we'll internationalize in the JS files.
	wp_localize_script( 'exhale-editor', 'exhaleEditor', [
		'labels' => [
			'border'     => __( 'Bordered', 'exhale' ),
			'borderless' => __( 'No Border', 'exhale' )
		]
	] );

	// Enqueue theme editor styles.
	wp_enqueue_style( 'exhale-editor', asset( 'css/editor.css' ), null, null );

	wp_add_inline_style( 'exhale-editor', App::resolve( CustomProperties::class )->css() );

	// Unregister core block and theme styles.
	wp_deregister_style( 'wp-block-library' );
	wp_deregister_style( 'wp-block-library-theme' );

	// Re-register core block and theme styles with an empty string. This is
	// necessary to get styles set up correctly.
	wp_register_style( 'wp-block-library', '' );
	wp_register_style( 'wp-block-library-theme', '' );

} );

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
