<?php
/**
 * Theme setup.
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
 * Setup class.
 *
 * @since  3.0.0
 * @access public
 */
class Setup implements Bootable {

	/**
	 * Bootstraps the class' actions/filters.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {
		add_action( 'after_setup_theme', [ $this, 'addThemeSupport' ], 5 );
		add_action( 'hybrid/templates/register', [ $this, 'registerTemplates' ] );
	}

	/**
	 * Set up theme support.  This is where calls to `add_theme_support()` happen.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function addThemeSupport() {

		// Load theme translations.
		load_theme_textdomain( 'exhale', get_parent_theme_file_path( 'public/lang' ) );

		// Remove core block patterns.
		remove_theme_support( 'core-block-patterns' );

		// Let core handle responsive embed wrappers.
		add_theme_support( 'responsive-embeds' );

		// Add support for editor styles (need this for `add_editor_style()`).
		add_theme_support( 'editor-styles' );

		// Automatically add feed links to `<head>`.
		//add_theme_support( 'automatic-feed-links' );

		// Adds featured image support.
		add_theme_support( 'post-thumbnails' );

		// Wide and full alignment.
		//add_theme_support( 'align-wide' );

		// Outputs HTML5 markup for core features.
		add_theme_support( 'html5', [
			'caption',
			'comment-form',
			'comment-list',
			'gallery',
			'search-form'
		] );
	}

	/**
	 * Registers custom templates with WordPress.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $templates
	 * @return void
	 */
	public function registerTemplates( $templates ) {

		$templates->add( 'template-canvas', [
			'label' => __( 'Canvas', 'exhale' )
		] );

		$templates->add( 'template-canvas-content', [
			'label' => __( 'Canvas: Content', 'exhale' )
		] );

		$templates->add( 'template-canvas-overlay-header', [
			'label' => __( 'Canvas: Overlay Header', 'exhale' )
		] );
	}
}
