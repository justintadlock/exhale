<?php

namespace Exhale\Template;

use Hybrid\Carbon\Image;
use Exhale\Tools\Mod;

class FeaturedImage extends Image {

	public static function carbon( $type, array $args = [] ) {

		$post_id = ! empty( $args['post_id'] ) ? $args['post_id'] : get_the_ID();
		$context = '';

		if ( is_customize_preview() ) {
			$context = sprintf(
				' data-customize-partial-placement-context="%s"',
				esc_attr( wp_json_encode( [ 'post_id' => $post_id ] ) )
			);
		}

		if ( ! isset( $args['link'] ) ) {
			$args['link'] = true;
		}

		$args['size']    = Mod::get( 'featured_image_size', 'exhale-wide' );
		$args['class']   = 'entry__image aligncenter';
		$args['post_id'] = $post_id;
		$args['before']  = sprintf( '<figure class="entry__media alignfull"%s>', $context );
		$args['after']   = '</figure>';

		return parent::carbon( $type, $args );
	}
}
