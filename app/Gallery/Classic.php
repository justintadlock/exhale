<?php
/**
 * Classic gallery component.
 *
 * Changes the classic gallery shortcode output to match the gallery block.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Gallery;

use Hybrid\Contracts\Bootable;

/**
 * Classic gallery component class.
 *
 * @since  2.1.0
 * @access public
 */
class Classic implements Bootable {

	/**
	 * Bootstraps the class' actions/filters.
	 *
	 * @since  2.1.0
	 * @access public
	 * @return void
	 */
	public function boot() {
		add_filter( 'post_gallery', [ $this, 'gallery' ], PHP_INT_MAX, 2 );
	}

	/**
	 * Filters the core WP `post_gallery` hook to change the [gallery]
	 * shortcode output.
	 *
	 * @since  2.1.0
	 * @access public
	 * @param  string  $output
	 * @param  array   $attr
	 * @return void
	 */
	public function gallery( $output, $attr ) {

		if ( $output || is_feed() ) {
			return $output;
		}

		$post = get_post();

		$atts = shortcode_atts( [
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post ? $post->ID : 0,
			'columns'    => 3,
			'include'    => '',
			'exclude'    => '',
			'link'       => ''
		], $attr, 'gallery' );

		$id   = intval( $atts['id'] );
		$size = 'large';

		// Set up the query arguments for getting the attachments.
		$children = [
			'post_status'      => 'inherit',
			'post_type'        => 'attachment',
			'post_mime_type'   => 'image',
			'order'            => $atts['order'],
			'orderby'          => $atts['orderby'],
			'exclude'          => $atts['exclude'],
			'include'          => $atts['include'],
			'numberposts'      => $atts['numberposts'],
			'offset'           => $atts['offset'],
			'suppress_filters' => true
		];

		// Query the attachments.
		if ( $atts['include'] ) {

			$attachments = get_posts( $children );

		} else {

			$attachments = get_children(
				array_merge(
					[ 'post_parent' => $id ],
					$children
				)
			);
		}

		// Bail if no attachments found.
		if ( ! $attachments ) {
			return '';
		}

		// Loop through the attachments and build the HTML output.
		foreach ( $attachments as $attachment ) {

			$image = $caption = '';

			// Get the image HTML.
			if ( 'file' == $atts['link'] ) {
				$image = wp_get_attachment_link( $attachment->ID, $size, false, true );
			} elseif ( 'none' == $atts['link'] ) {
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
			$output .= sprintf(
				'<li class="blocks-gallery-item"><figure>%s%s</figure></li>',
				$image,
				$caption
			);
		}

		// Add the gallery wrapper.
		$output = sprintf(
			'<ul class="wp-block-gallery alignwide columns-%s is-cropped">%s</ul>',
			absint( $atts['columns'] ),
			$output
		);

		return $output;
	}
}
