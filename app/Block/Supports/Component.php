<?php
/**
 * Block component.
 *
 * Handles the block feature.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Block\Supports;

use Hybrid\Contracts\Bootable;

/**
 * Block component class.
 *
 * @since  3.0.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Bootstraps the class' actions/filters.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {
		add_filter( 'block_type_metadata', [ $this, 'supports'] );

		// apply_filters( 'render_block', string $block_content, array $block )

		add_filter( 'render_block', function( $content ) {
			return preg_replace(
				"/(class=['\"].*?)has-(\d)-xl-font-size(.*?['\"])/i",
				"$1has-$2xl-font-size$3",
				$content
			);
		});
	}

	public function supports( $meta ) {

		if ( in_array( $meta['name'], [
			'core/button',
			'core/code',
			'core/column',
			'core/columns',
			'core/gallery',
			'core/group',
			'core/heading',
			'core/image',
			'core/list',
			'core/quote',
			'core/paragraph',
			'core/post-comments-link',
			'core/post-author',
			'core/post-date',
			'core/post-excerpt',
			'core/post-terms',
			'core/post-title',
			'core/pullquote',
			'core/term-description'
		] ) ) {
			$meta['supports']['typography']['fontSize'] = true;
			$meta['supports']['typography']['__experimentalFontStyle'] = true;
			$meta['supports']['typography']['lineHeight'] = true;
			$meta['supports']['typography']['__experimentalFontFamily'] = true;
			$meta['supports']['typography']['__experimentalFontWeight'] = true;
			$meta['supports']['typography']['__experimentalTextTransform'] = true;
			$meta['supports']['typography']['__experimentalTextDecoration'] = true;
		}

		if ( 'core/heading' === $meta['name'] ) {
			$meta['supports']['__experimentalLetterSpacing'] = true;
		}


		if ( 'core/quote' === $meta['name'] ) {
			$meta['supports']['typography']['fontSize'] = true;
			$meta['supports']['typography']['lineHeight'] = true;
		}

		if ( 'core/image' === $meta['name'] ) {
		//	$meta['supports']['color']['__experimentalDuotone'] = true;
		}

		if ( in_array( $meta['name'], [
			'core/code',
			'core/cover',
			'core/columns',
			'core/column',
			'core/media-text'
		] ) ) {
			$meta['supports']['__experimentalBorder'] = true;
		}

		if ( in_array( $meta['name'], [
			'core/post-content',
			'core/post-date',
			'core/post-excerpt',
			'core/post-featured-image',
			'core/post-title',
			'core/columns',
			'core/group',
			'core/heading',
			'core/code',
			'core/cover',
			'core/list',
			'core/navigation',
			'core/paragraph',
			'core/separator',
			'core/social-links',
			'core/site-title'
		] ) ) {
			if ( ! isset( $meta['supports']['spacing'] ) ) {
				$meta['supports']['spacing'] = [];
			}
			$meta['supports']['spacing']['margin'] = true;
		}

		if ( in_array( $meta['name'], [
			'core/code',
			'core/columns',
			'core/column',
			'core/list',
			'core/media-text',
			'core/navigaiton',
			'core/paragraph',
			'core/post-excerpt',
			'core/quote',
			'core/social-links'
		] ) ) {
			if ( ! isset( $meta['supports']['spacing'] ) ) {
				$meta['supports']['spacing'] = [];
			}
			$meta['supports']['spacing']['padding'] = true;
		}

		if ( in_array( $meta['name'], [
			'core/code',
			'core/column',
			'core/quote'
		] ) ) {
			$meta['supports']['color']['text'] = true;
			$meta['supports']['color']['link'] = true;
			$meta['supports']['color']['background'] = true;
			$meta['supports']['color']['gradients'] = true;
		}

		if ( in_array( $meta['name'], [
			'core/heading'
		] ) ) {
			$meta['supports']['color']['gradients'] = true;
		}

		if ( in_array( $meta['name'], [
			'core/image'
		] ) ) {
			$meta['supports']['color']['text'] = true;
			$meta['supports']['color']['link'] = true;
			$meta['supports']['color']['background'] = true;
			$meta['supports']['color']['gradients'] = true;

			$meta['supports']['spacing']['margin'] = true;
			$meta['supports']['spacing']['padding'] = true;
		}

		if ( in_array( $meta['name'], [
			'core/heading',
		] ) ) {
			$meta['supports']['__experimentalLetterSpacing'] = true;
		}

		return $meta;
	}
}
