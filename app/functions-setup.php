<?php
/**
 * Theme setup functions.
 *
 * This file holds basic theme setup functions executed on appropriate hooks
 * with some opinionated priorities based on theme dev, particularly working
 * with child theme devs/users, over the years. I've also decided to use
 * anonymous functions to keep these from being easily unhooked. WordPress has
 * an appropriate API for unregistering, removing, or modifying all of the
 * things in this file. Those APIs should be used instead of attempting to use
 * `remove_action()`.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale;

use Exhale\Tools\Config;

/**
 * Set up theme support.  This is where calls to `add_theme_support()` happen.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'after_setup_theme', function() {

	// Sets the theme content width.
	$GLOBALS['content_width'] = 640;

	// Load theme translations.
	load_theme_textdomain( 'exhale', get_parent_theme_file_path( 'public/lang' ) );

	// Automatically add the `<title>` tag.
	add_theme_support( 'title-tag' );

	// Automatically add feed links to `<head>`.
	add_theme_support( 'automatic-feed-links' );

	// Adds featured image support.
	add_theme_support( 'post-thumbnails' );

	// Add selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Wide and full alignment.
	add_theme_support( 'align-wide' );

	// Outputs HTML5 markup for core features.
	add_theme_support( 'html5', [
		'caption',
		'comment-form',
		'comment-list',
		'gallery',
		'search-form'
	] );

	// Add custom logo support.
	add_theme_support( 'custom-logo', [
		'width'       => null,
		'height'      => 58,
		'flex-width'  => true,
		'flex-height' => true,
		'header-text' => [
			'app-header__title',
			'app-header__description'
		]
	] );

}, 5 );

/**
 * Adds a custom background if supported. Child themes can pass their custom
 * background arguments via a `config/custom-background.php` file that returns
 * an array.
 *
 * @since  1.2.0
 * @access public
 * @return void
 */
add_action( 'after_setup_theme', function() {

	$config = Config::get( 'custom-background' );

	if ( is_array( $config ) ) {
		add_theme_support( 'custom-background', $config );
	}

}, 15 );

/**
 * Register menus.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
add_action( 'init', function() {

	register_nav_menus( [
		'primary' => esc_html_x( 'Primary', 'nav menu location', 'exhale' ),
		'footer'  => esc_html_x( 'Footer',  'nav menu location', 'exhale' ),
		'social'  => esc_html_x( 'Social',  'nav menu location', 'exhale' )
	] );

}, 5 );

/**
 * Register sidebars.
 *
 * @since  2.1.0
 * @access public
 * @return void
 */
add_action( 'widgets_init', function() {

	$args = [
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget__title">',
		'after_title'   => '</h3>'
	];

	foreach ( range( 1, 4 ) as $num ) {

		register_sidebar( [
			'id'   => "footer-{$num}",
			'name' => sprintf( __( 'Footer %d', 'exhale' ), $num )
		] + $args );
	}

}, 5 );

/**
 * Changes the theme template path to the `public/views` folder.
 *
 * @since  1.0.0
 * @access public
 * @return string
 */
add_filter( 'hybrid/template/path', function() {
	return 'public/views';
} );

/**
 * Registers custom templates with WordPress.
 *
 * @since  1.0.0
 * @access public
 * @param  object  $templates
 * @return void
 */
add_action( 'hybrid/templates/register', function( $templates ) {

	$templates->add( 'template-canvas.php', [
		'label' => __( 'Content Canvas', 'exhale' )
	] );

	$templates->add( 'template-landing.php', [
		'label' => __( 'Landing', 'exhale' )
	] );

	$templates->add( 'template-landing-canvas.php', [
		'label' => __( 'Landing: Content Canvas', 'exhale' )
	] );

	//$templates->add( 'template-entry-content-only.php', [
	//	'label' => __( 'No Post Header/Footer', 'exhale' )
	//] );

} );
