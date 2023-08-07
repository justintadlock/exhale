<?php
/**
 * Classic gallery component.
 *
 * Changes the classic gallery shortcode output to match the gallery block.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Gallery;

use Hybrid\Contracts\Bootable;

/**
 * Classic gallery component class.
 *
 * @since  2.1.0
 *
 * @access public
 */
class Classic implements Bootable {

    /**
     * Bootstraps the class' actions/filters.
     *
     * @since  2.1.0
     * @return void
     *
     * @access public
     */
    public function boot() {
        add_filter( 'post_gallery', [ $this, 'gallery' ], PHP_INT_MAX, 2 );
    }

    /**
     * Filters the core WP `post_gallery` hook to change the [gallery]
     * shortcode output.
     *
     * @since  2.1.0
     * @param  string $output
     * @param  array  $attr
     * @return void
     *
     * @access public
     */
    public function gallery( $output, $attr ) {

        if ( $output || is_feed() ) {
            return $output;
        }

        $post = get_post();

        $atts = shortcode_atts( [
            'columns' => 3,
            'exclude' => '',
            'id'      => $post ? $post->ID : 0,
            'include' => '',
            'link'    => '',
            'order'   => 'ASC',
            'orderby' => 'menu_order ID',
        ], $attr, 'gallery' );

        $id   = intval( $atts['id'] );
        $size = 'large';

        // Set up the query arguments for getting the attachments.
        $children = [
            'exclude'          => $atts['exclude'],
            'include'          => $atts['include'],
            'order'            => $atts['order'],
            'orderby'          => $atts['orderby'],
            'post_mime_type'   => 'image',
            'post_status'      => 'inherit',
            'post_type'        => 'attachment',
            'suppress_filters' => true,
        ];

        // Query the attachments.
        $attachments = $atts['include'] ? get_posts( $children ) : get_children(
            array_merge(
                [ 'post_parent' => $id ],
                $children
            )
        );

        // Bail if no attachments found.
        if ( ! $attachments ) {
            return '';
        }

        // Loop through the attachments and build the HTML output.
        foreach ( $attachments as $attachment ) {

            $image = $caption = '';

            // Get the image HTML.
            if ( 'file' === $atts['link'] ) {
                $image = wp_get_attachment_link( $attachment->ID, $size, false, true );
            } elseif ( 'none' === $atts['link'] ) {
                $image = wp_get_attachment_image( $attachment->ID, $size, false );
            } else {
                $image = wp_get_attachment_link( $attachment->ID, $size, true, true );
            }

            // Get the caption.
            if ( trim( $attachment->post_excerpt ) ) {
                $caption = sprintf(
                    '<figcaption>%s</figcaption>',
                    wptexturize( $attachment->post_excerpt )
                );
            }

            // Create the gallery item HTML.
            $output .= sprintf( '<li class="blocks-gallery-item"><figure>%s%s</figure></li>', $image, $caption );
        }

        // Add the gallery wrapper.
        $output = sprintf(
            '<ul class="wp-block-gallery %s columns-%s is-cropped">%s</ul>',
            in_the_loop() ? 'alignwide' : 'alignnone',
            absint( $atts['columns'] ),
            $output
        );

        return $output;
    }

}
