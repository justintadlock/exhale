<?php
/**
 * Theme assets handling.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale;

use Hybrid\Contracts\Bootable;

/**
 * Assets class.
 *
 * @since  3.0.0
 * @access public
 */
class Assets implements Bootable {

	/**
	 * Bootstraps the class' actions/filters.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		// Front-end and editor.
		add_action( 'enqueue_block_assets', [ $this, 'enqueueBlockAssets'] );

		// Front-end only.
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueueAssets' ] );

		// Editor only.
		add_action( 'admin_init', [ $this, 'addEditorStyles' ] );
		add_action( 'enqueue_block_editor_assets', [ $this, 'enqueueEditorAssets' ] );
	}

	/**
	 * Enqueue scripts/styles for the front end.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function enqueueAssets() {

		// Load WordPress' comment-reply script where appropriate.
		if ( is_singular() && get_option( 'thread_comments' ) && comments_open() ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Enqueue theme scripts.
		wp_enqueue_script( 'exhale-app', asset( 'js/app.js' ), null, null, true );

		// Enqueue theme styles.
		wp_enqueue_style( 'exhale-fonts',  fonts_url(), null, null );
		wp_enqueue_style( 'exhale-screen', asset( 'css/screen.css' ), null, null );
	}

	/**
	 * Unregisters the core block editor assets on the front end and admin.
	 *
	 * @link https://github.com/WordPress/gutenberg/issues/15007
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function enqueueBlockAssets() {

		// Unregister core theme styles.
		wp_deregister_style( 'wp-block-library-theme' );

		// Re-register core theme styles with an empty string. This is
		// necessary to get styles set up correctly.
		wp_register_style( 'wp-block-library-theme', '' );
	}

	/**
	 * Add editor stylesheets.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function addEditorStyles() {

		add_editor_style( [
			fonts_url(),
			asset( 'css/editor.css' )
		] );
	}

	/**
	 * Enqueue scripts/styles for the editor.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function enqueueEditorAssets() {

		// Add dependencies.
		$deps = [
			'wp-i18n',
			'wp-blocks',
			'wp-dom-ready',
			'wp-edit-post',
			'wp-element',
			'wp-token-list'
		];

		// Add labels.
		$labels = [
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

		// Enqueue scripts.
		wp_enqueue_script( 'exhale-editor', asset( 'js/editor.js' ), $deps, null, true );

		// Pass variables to JavaScript.
		wp_localize_script( 'exhale-editor', 'exhaleEditor', [ 'labels' => $labels ] );
	}
}
