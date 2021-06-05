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

/**
 * Enqueue scripts/styles for the front end.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'wp_enqueue_scripts', function() {

	// Disable core block styles.
	//wp_dequeue_style( 'wp-block-library' );

	// Load WordPress' comment-reply script where appropriate.
	if ( is_singular() && get_option( 'thread_comments' ) && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Enqueue theme scripts.
	wp_enqueue_script( 'exhale-app', asset( 'js/app.js' ), null, null, true );

	// Enqueue theme styles.
	wp_enqueue_style(
		'exhale-screen',
		asset( 'css/screen.css' ),
		null,
		null
	);

} );

/**
 * Unregisters the core block editor assets on the front end and admin.
 *
 * @link https://github.com/WordPress/gutenberg/issues/15007
 * @since  1.1.0
 * @access public
 * @return void
 */
add_action( 'enqueue_block_assets', function() {

	// Unregister core block and theme styles.
	//wp_deregister_style( 'wp-block-library' );
	//wp_deregister_style( 'wp-block-library-theme' );

	// Re-register core block and theme styles with an empty string. This is
	// necessary to get styles set up correctly.
	//wp_register_style( 'wp-block-library', '' );
	//wp_register_style( 'wp-block-library-theme', '' );
} );

add_action( 'admin_init', function() {
	add_editor_style( [ asset( 'css/editor.css' ) ] );
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
		'wp-element',
		'wp-token-list'
	];

	wp_enqueue_script( 'exhale-editor', asset( 'js/editor.js' ), $deps, null, true );

	// For now, we're adding translations via PHP. In the future, when our
	// tools catch up, we'll internationalize in the JS files.
	wp_localize_script( 'exhale-editor', 'exhaleEditor', [
		'labels' => editor_script_labels()
	] );

	// Enqueue theme editor styles.
	//wp_enqueue_style( 'exhale-editor', asset( 'css/editor.css' ), null, null );

} );

function editor_script_labels() {
	return [
		'default'        => __( 'Default',         'exhale' ),
		'borderDouble'   => __( 'Double',          'exhale' ),
		'borderDashed'   => __( 'Dashed',          'exhale' ),
		'borderRadius'   => __( 'Border Radius',   'exhale' ),
		'designSettings' => __( 'Design Settings', 'exhale' ),
		'highlight'      => __( 'Highlight',       'exhale' ),
		'listType'       => __( 'Bullets',         'exhale' ),
		'noGap'          => __( 'No Gap',          'exhale' ),
		'none'           => __( 'None',            'exhale' ),
		'reverse'        => __( 'Reverse',         'exhale' ),
		'rounded'        => __( 'Rounded',         'exhale' ),
		'shadow'         => __( 'Shadow',          'exhale' ),

		// Lists.
		'lists' => [
			'disc'   => __( 'Disc',   'exhale' ),
			'circle' => __( 'Circle', 'exhale' ),
			'square' => __( 'Square', 'exhale' )
		],

		// Sizes.
		'sizes' => [
			'fine'       => __( 'Fine',        'exhale' ),
			'diminutive' => __( 'Diminutive',  'exhale' ),
			'tiny'       => __( 'Tiny',        'exhale' ),
			'small'      => __( 'Small',       'exhale' ),
			'medium'     => __( 'Medium',      'exhale' ),
			'large'      => __( 'Large',       'exhale' ),
			'extraLarge' => __( 'Extra Large', 'exhale' ),
			'huge'       => __( 'Huge',        'exhale' ),
			'gargantuan' => __( 'Gargantuan',  'exhale' ),
			'colossal'   => __( 'Colossal',    'exhale' )
		]
	];
}

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
