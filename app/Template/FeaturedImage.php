<?php
/**
 * Featured Image Class.
 *
 * A class that extends the `Hybrid\Carbon\Image` static helper class and rolls
 * out custom options specifically for the theme.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Template;

use Hybrid\Carbon\Image;
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

		$args['size']    = Mod::get( 'featured_image_size', 'exhale-landscape-large' );
		$args['class']   = 'entry__image aligncenter';
		$args['post_id'] = $post_id;
		$args['before']  = sprintf( '<figure class="entry__media alignfull"%s>', $context );
		$args['after']   = '</figure>';

		return parent::carbon( $type, $args );
	}
}
