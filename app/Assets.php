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
use WP_Theme_JSON_Resolver_Gutenberg as ThemeJsonResolver;

/**
 * Assets class.
 *
 * @since  3.0.0
 * @access public
 */
class Assets implements Bootable {

	protected $mix = [];

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

	protected function mix() {

		if ( $this->mix ) {
			return $this->mix;
		}

		$file     = get_parent_theme_file_path( 'public/mix-manifest.json' );
		$this->mix = (array) json_decode( file_get_contents( $file ), true );

		if ( is_child_theme() ) {
			$child = get_stylesheet_directory() . '/public/mix-manifest.json';

			if ( file_exists( $child ) ) {
				$this->mix = array_merge(
					$this->mix,
					(array) json_decode( file_get_contents( $file ), true )
				);
			}
		}

		return $this->mix;
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
	public function asset( $path ) {

		// Get the Laravel Mix manifest.
		$manifest = $this->mix();

		// Make sure to trim any slashes from the front of the path.
		$path = '/' . ltrim( $path, '/' );

		if ( $manifest && isset( $manifest[ $path ] ) ) {
			$path = $manifest[ $path ];
		}

		return get_theme_file_uri( 'public' . $path );
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
		wp_enqueue_script( 'exhale-app', $this->asset( 'js/app.js' ), null, null, true );

		// Enqueue theme styles.
		wp_enqueue_style( 'exhale-fonts',  $this->fontsUrl(), null, null );
		wp_enqueue_style( 'exhale-screen', $this->asset( 'css/screen.css' ), null, null );
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
			$this->fontsUrl(),
			$this->asset( 'css/editor.css' )
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
		wp_enqueue_script( 'exhale-editor', $this->asset( 'js/editor.js' ), $deps, null, true );

		// Pass variables to JavaScript.
		wp_localize_script( 'exhale-editor', 'exhaleEditor', [ 'labels' => $labels ] );
	}

	/**
	 * Returns the stylesheet URL for loading fonts.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	protected function fontsUrl() {
		$url = '';

		if ( ! class_exists( ThemeJsonResolver::class ) ) {
			return $url;
		}

		$data = ThemeJsonResolver::get_merged_data()->get_settings();

		if ( ! empty( $data['custom'] && isset( $data['custom']['googleFonts'] ) ) ) {

			$fonts = $data['custom']['googleFonts'];

			$url = ! $fonts ?: esc_url_raw(
				sprintf(
					'https://fonts.googleapis.com/css2?%s',
					implode( '&', (array) $fonts )
				)
			);
		}

		return apply_filters( 'exhale/assets/fonts/url', $url );
	}
}
