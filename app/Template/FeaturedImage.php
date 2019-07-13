<?php
/**
 * Featured Image Class.
 *
 * A class that extends the `Hybrid\Carbon\Image` static helper class and rolls
 * out custom options specifically for the theme.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Template;

use Hybrid\App;
use Hybrid\Carbon\Image;
use Exhale\Image\Size\Sizes;
use Exhale\Tools\Mod;

/**
 * Featured image class.
 *
 * @since  1.0.0
 * @access public
 */
class FeaturedImage extends Image {

	/**
	 * Creates an instance of the `Hybrid\Carbon\Carbon` class.
	 *
	 * @since  1.0.0
	 * @param string|array  $type
	 * @param array         $args
	 * @return \Hybrid\Carbon\Carbon
	 */
	public static function carbon( $type, array $args = [] ) {

		$post_id = ! empty( $args['post_id'] ) ? $args['post_id'] : get_the_ID();
		$context = '';

		// If we're viewing this in the customize preview frame, we need
		// to add an attribute, which will pass our custom context back
		// to the partial render method.
		if ( is_customize_preview() ) {
			$data = [ 'post_id' => $post_id ];

			$context = sprintf(
				' data-customize-partial-placement-context="%s"',
				esc_attr( wp_json_encode( $data ) )
			);
		}

		// Link to posts by default.
		if ( ! isset( $args['link'] ) ) {
			$args['link'] = true;
		}


		$args['attr']['loading'] = 'auto';

		if ( 0 < $GLOBALS['wp_query']->current_post ) {
			$args['attr']['loading'] = 'lazy';
		}

		$l_type = is_home() ? 'blog' : 'archive';

		$args['size']    = Mod::get( "loop_{$l_type}_image_size" );
		$args['class']   = 'entry__image aligncenter';
		$args['post_id'] = $post_id;
		$args['before']  = sprintf( '<figure class="entry__media alignfull"%s>', $context );
		$args['after']   = '</figure>';

		return parent::carbon( $type, $args );
	}


       public static function display( $type, array $args = [] ) {
	       echo static::render( $type, $args );
       }

	/**
	 * Returns the image HTML.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array|string  $type
	 * @param  array         $args
	 * @return string
	 */
	public static function render( $type, array $args = [] ) {

		$image = static::image( $type, $args );

		if ( $image ) {
			return $image->render();
		}

		$l_type = is_home() ? 'blog' : 'archive';

		$layout = App::resolve( 'layouts/loop' )->get( Mod::get( "loop_{$l_type}_layout" ) );

		if ( is_home() || is_archive() && $layout->requiresImage() ) {
			return static::svgFallback( $type, $args );
		}

		return '';
	}

	private static function svgFallback( $type, array $args = [] ) {

		$l_type = is_home() ? 'blog' : 'archive';

		$size = App::resolve( Sizes::class )->get( Mod::get( "loop_{$l_type}_image_size" ) );

		$post_id = ! empty( $args['post_id'] ) ? $args['post_id'] : get_the_ID();
		$context = '';

			// If we're viewing this in the customize preview frame, we need
			// to add an attribute, which will pass our custom context back
			// to the partial render method.
			if ( is_customize_preview() ) {
				$data = [ 'post_id' => $post_id ];

				$context = sprintf(
					' data-customize-partial-placement-context="%s"',
					esc_attr( wp_json_encode( $data ) )
				);
			}

		return sprintf(
			'<figure class="entry__media alignfull"%1$s><a href="%2$s">
				<?xml version="1.0"?>
				<svg class="entry__image aligncenter" fill="#%3$s" width="%4$s" height="%5$s" viewBox="0 0 %4$s %5$s">
					<rect class="svg-shape" width="%4$s" height="%5$s" />
				</svg>
			</a></figure>',
			$context,
			esc_url( get_permalink( $args['post_id'] ) ),
			sanitize_hex_color_no_hash( \Exhale\Tools\Mod::color( 'primary-link' ) ),
			esc_attr( $size->width() ),
			esc_attr( $size->height() )
		);
	}
}
