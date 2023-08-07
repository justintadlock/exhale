<?php
/**
 * WooCommerce integration.
 *
 * This file integrates the theme with WooCommerce.
 *
 * @package   Mythic
 * @link      https://themehybrid.com/themes/mythic
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Exhale;

use function Hybrid\Template\path;

/**
 * Adds theme support for the WooCommerce plugin.
 *
 * @since  2.1.0
 * @return void
 *
 * @access public
 */
add_action( 'after_setup_theme', static function() {

    add_theme_support( 'woocommerce' );
} );

/**
 * This overrides the top-level WooCommerce templates that would normally go in
 * the theme root. By default, we're looking for a `resources/views/woocommerce.php`
 * template, which falls back to `resources/views/index.php`.
 *
 * @since  2.1.0
 * @param  array  $files
 * @return array
 *
 * @access public
 */
add_filter( 'woocommerce_template_loader_files', static fn( $files ) => [
    path( 'woocommerce.php' ),
    path( 'index.php' ),
], PHP_INT_MAX );

/**
 * Filters the path to the `woocommerce` template parts folder.  This filter
 * moves that folder to `resources/views/woocommerce`.
 *
 * @since  2.1.0
 * @param  string  $path
 * @return string
 *
 * @access public
 */
add_filter( 'woocommerce_template_path', static fn( $path ) => path( $path ) );

/**
 * Fixes the archive title on the product archive.
 *
 * @since  2.1.0
 * @param  string  $title
 * @return string
 *
 * @access public
 */
add_filter( 'get_the_archive_title', static function( $title ) {

    if ( is_post_type_archive( 'product' ) && function_exists( 'woocommerce_page_title' ) ) {
        $title = woocommerce_page_title( false );
    }

    return $title;
} );

/**
 * Fixes the archive description on the product archive.
 *
 * @since  2.1.0
 * @param  string  $desc
 * @return string
 *
 * @access public
 */
add_filter( 'get_the_archive_description', static function( $desc ) {

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
 * @param  array  $classes
 * @return array
 *
 * @access public
 */
add_filter( 'woocommerce_post_class', static function( $classes ) {

    if ( is_singular( 'product' ) ) {
        $classes[] = 'o-content-width';
    }

    return $classes;
} );
