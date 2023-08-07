<?php
/**
 * Theme filters and actions.
 *
 * Adds and defines custom filters and actions the theme adds to core WordPress.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale;

use Exhale\Settings\Options;
use Exhale\Template\ErrorPage;
use Exhale\Tools\Config;
use Exhale\Tools\Svg;

// Add social icons.
add_filter( 'walker_nav_menu_start_el', __NAMESPACE__ . '\nav_menu_social_icons', 10, 4 );

/**
 * Adds error data for the 404 content template. Passes in the `ErrorPage` object
 * as the `$error` variable.
 *
 * @since  1.0.0
 * @param  \Exhale\Tools\Collection  $data
 * @return \Exhale\Tools\Collection
 *
 * @access public
 */
add_filter( 'hybrid/view/content/data', static function( $data ) {

    if ( is_404() ) {
        $data->add( 'error', new ErrorPage() );
    }

    return $data;
} );

/**
 * Filters the post states on the manage pages screen. Adds a "404 Page" state
 * to show users which page has been assigned as their 404 page.
 *
 * @since  1.0.0
 * @param  array    $states
 * @param  \WP_Post $post
 * @return array
 *
 * @access public
 */
add_filter( 'display_post_states', static function( $states, $post ) {

    if ( 'page' === $post->post_type && $post->ID === absint( Options::get( 'error_page' ) ) ) {
        $states['exhale_error_404'] = __( '404 Page', 'exhale' );
    }

    return $states;
}, 10, 2 );

/**
 * Filters the excerpt length.
 *
 * @since  1.0.0
 * @return int
 *
 * @access public
 */
add_filter( 'excerpt_length', static fn() => 20, 5 );

/**
 * Filters the excerpt more link.
 *
 * @since  1.0.0
 * @return string
 *
 * @access public
 */
add_filter( 'excerpt_more', static fn() => sprintf(
    '&thinsp;&hellip;&thinsp;<a href="%s" class="entry__more-link italic">%s</a>',
    esc_url( get_permalink() ),
    sprintf(
            // Translators: %s is the post title for screen readers.
        esc_html__( 'Continue reading&nbsp;%s&nbsp;&rarr;', 'exhale' ),
        the_title( '<span class="screen-reader-text">', '</span>', false )
    )
) );

/**
 * Adds social icon SVGs to the social menu.
 *
 * @since  1.0.0
 * @param  string $item_output
 * @param  object $item
 * @param  int    $depth
 * @param  array  $args
 * @return string
 *
 * @access public
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

add_filter( 'nav_menu_css_class', static function( $classes, $items, $args, $depth ) {

    if ( 'primary' === $args->theme_location ) {
        $classes[] = 'md:inline';
    } elseif ( 'footer' === $args->theme_location ) {
        $classes[] = 'inline mx-4';
    } elseif ( 'social' === $args->theme_location ) {
        $classes[] = 'inline mx-2';
    }

    return $classes;
}, 15, 4 );

add_filter( 'nav_menu_link_attributes', static function( $attr, $item, $args, $depth ) {

    if ( 'primary' === $args->theme_location ) {
        $attr['class'] .= ' block md:inline-block px-8 py-4 md:p-6 md:h-full no-underline hover:underline focus:underline';
    } elseif ( 'footer' === $args->theme_location ) {
        $attr['class'] .= ' no-underline hover:underline focus:underline';
    } elseif ( 'social' === $args->theme_location ) {
        $attr['class'] .= ' inline-flex';
    }

    return $attr;
}, 15, 4 );

/**
 * Converts old page template slugs to the updated slug.
 *
 * @since  2.0.0
 * @return void
 *
 * @access public
 */
add_action( 'template_redirect', static function() {

    if ( is_singular() ) {
        $post_id = get_queried_object_id();

        if ( 'template-entry-content-only.php' === get_page_template_slug( $post_id ) ) {
            update_post_meta( $post_id, '_wp_page_template', 'template-canvas.php' );
        }
    }
}, ~PHP_INT_MAX );

/**
 * Changes the `<span>` wrapper for entry terms to a `<div>`.
 *
 * @since  2.1.0
 * @param  string  $html
 * @return string
 *
 * @access public
 */
add_filter( 'hybrid/post/terms', static fn( $html ) => str_replace(
    [ '<span', '</span>' ],
    [ '<div', '</div>' ],
    $html
) );
