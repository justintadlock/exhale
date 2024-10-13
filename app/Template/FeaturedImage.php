<?php
/**
 * Featured Image Class.
 *
 * A class that extends the `Hybrid\Carbon\Image` static helper class and rolls
 * out custom options specifically for the theme.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Template;

use Exhale\Tools\Mod;
use Hybrid\Carbon\Image;

/**
 * Featured image class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class FeaturedImage extends Image {

    /**
     * Creates an instance of the `Hybrid\Carbon\Carbon` class.
     *
     * @since  1.0.0
     * @param string|array $type
     * @param array        $args
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

        // Put the class on the wrapper.
        $class = $args['class'] ?? 'entry__media';

        $args['size']       = Loop::imageSize()->name();
        $args['link_class'] = 'entry__image-link inline-block align-top';
        $args['class']      = 'entry__image block mx-auto';
        $args['post_id']    = $post_id;
        $args['before']     = sprintf(
            '<figure class="%s"%s>',
            esc_attr( $class ),
            $context
        );
        $args['after']      = '</figure>';

        return parent::carbon( $type, $args );
    }

    /**
     * Outputs the image HTML.
     *
     * @since  2.1.0
     * @param  array|string $type
     * @param  array        $args
     * @return string
     *
     * @access public
     */
    public static function display( $type, array $args = [] ) {
        echo static::render( $type, $args );
    }

    /**
     * Returns the image HTML.
     *
     * @since  2.1.0
     * @param  array|string $type
     * @param  array        $args
     * @return string
     *
     * @access public
     */
    public static function render( $type, array $args = [] ) {

        $image = static::image( $type, $args );

        return $image ? $image->render() : static::svgFallback( $type, $args );
    }

    /**
     * SVG image fallback shown for layouts that require an image.
     *
     * @since  2.1.0
     * @param  array|string $type
     * @param  array        $args
     * @return string
     *
     * @access public
     */
    private static function svgFallback( $type, array $args = [] ) {

        if ( ! ( is_home() || is_archive() ) || ! Loop::layout()->requiresImage() ) {
            return '';
        }

        $post_id = ! empty( $args['post_id'] ) ? $args['post_id'] : get_the_ID();
        $size    = Loop::imageSize();
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

        $svg = sprintf(
            '<svg class="entry__image block mx-auto" fill="#%1$s" width="%2$s" height="%3$s" viewBox="0 0 %2$s %3$s">
				<rect class="svg-shape" width="%2$s" height="%3$s" />
			</svg>',
            sanitize_hex_color_no_hash( Mod::color( 'primary-link' ) ),
            esc_attr( $size->width() ),
            esc_attr( $size->height() )
        );

        if ( ! isset( $args['link'] ) || $args['link'] ) {
            $svg = sprintf(
                '<a class="entry__image-link inline-block align-top" href="%s">%s</a>',
                esc_url( get_permalink( $post_id ) ),
                $svg
            );
        }

        // Put the class on the wrapper.
        $class = $args['class'] ?? 'entry__media';

        return sprintf(
            '<figure class="%s"%s>%s</figure>',
            esc_attr( $class ),
            $context,
            $svg
        );
    }

}
