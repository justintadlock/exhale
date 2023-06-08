<?php
/**
 * WooCommerce integration.
 *
 * This file integrates the theme with WooCommerce.
 *
 * @package   Mythic
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @link      https://themehybrid.com/themes/mythic
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Exhale;

use function Hybrid\Template\path;

/**
 * Adds theme support for the WooCommerce plugin.
 *
 * @since  2.1.0
 * @access public
 * @return void
 */
add_action( 'after_setup_theme', function() {

	add_theme_support( 'woocommerce' );
} );

/**
 * This overrides the top-level WooCommerce templates that would normally go in
 * the theme root. By default, we're looking for a `resources/views/woocommerce.php`
 * template, which falls back to `resources/views/index.php`.
 *
 * @since  2.1.0
 * @access public
 * @param  array  $files
 * @return array
 */
add_filter( 'woocommerce_template_loader_files', function( $files ) {

	return [
		path( 'woocommerce.php' ),
		path( 'index.php' )
	];

}, PHP_INT_MAX );

/**
 * Filters the path to the `woocommerce` template parts folder.  This filter
 * moves that folder to `resources/views/woocommerce`.
 *
 * @since  2.1.0
 * @access public
 * @param  string  $path
 * @return string
 */
add_filter( 'woocommerce_template_path', function( $path ) {

	return path( $path );
} );

/**
 * Fixes the archive title on the product archive.
 *
 * @since  2.1.0
 * @access public
 * @param  string  $title
 * @return string
 */
add_filter( 'get_the_archive_title', function( $title ) {

	if ( is_post_type_archive( 'product' ) && function_exists( 'woocommerce_page_title' ) ) {
		$title = woocommerce_page_title( false );
	}

	return $title;
} );

/**
 * Fixes the archive description on the product archive.
 *
 * @since  2.1.0
 * @access public
 * @param  string  $desc
 * @return string
 */
add_filter( 'get_the_archive_description', function( $desc ) {

	if ( is_post_type_archive( 'product' ) && function_exists( 'woocommerce_product_archive_description' ) ) {

		if ( function_exists( 'wc_get_page_id' ) ) {
			$shop = wc_get_page_id( 'shop' );

			if ( $shop ) {
				$desc = get_post_field( 'post_content', $shop, 'raw' );
			}
		}
	}

	return $desc;
} );

/**
 * Adds our content width object class for single products. In the future, this
 * should be removed in favor of a custom template.
 *
 * @since  2.1.0
 * @access public
 * @param  array  $classes
 * @return array
 */
add_filter( 'woocommerce_post_class', function( $classes ) {

	if ( is_singular( 'product' ) ) {
		$classes[] = 'o-content-width';
	}

	return $classes;
} );
