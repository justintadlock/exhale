<?php
/**
 * Theme filters and actions.
 *
 * Adds and defines custom filters and actions the theme adds to core WordPress.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale;

use Hybrid\App;
use Exhale\Tools\Config;
use Exhale\Tools\Svg;
use Exhale\Template\ErrorPage;
use Exhale\Template\BlockHierarchy;

// apply_filters( 'render_block', string $block_content, array $block )

add_filter( 'render_block', function( $content, $block ) {
	return $content;

	if (
		'core/navigation' === $block['blockName'] &&
		'primary-horizontal' === $block['attrs']['orientation'] &&
		true === $block['attrs']['isResponsive']
	) {
		$content = preg_replace(
			'/<button.*?>.*?<\/button>/',
			'',
			$content
		);
	}

	return $content;
}, PHP_INT_MAX, 2 );


//add_filter( 'should_load_separate_core_block_assets', '__return_false' );

// apply_filters( 'default_template_types', $default_template_types );

add_filter( 'default_template_types', function( $types ) {

	$types['single-page'] = [
		'title'       => __( 'Single Page' ),
		'description' => __( 'Template used to display individual pages.' ),
	];

	$types['single-attachment'] = [
		'title'       => __( 'Single Attachment (Media)' ),
		'description' => __( 'Template used to display individual media items or attachments.' ),
	];

	$types['single-attachment-image'] = [
		'title'       => __( 'Single Image Attachment' ),
		'description' => __( 'Template used to display individual images or attachments.' ),
	];

	$types['single-attachment-audio'] = [
		'title'       => __( 'Single Audio Attachment' ),
		'description' => __( 'Template used to display individual audio files or attachments.' ),
	];

	$types['single-attachment-video'] = [
		'title'       => __( 'Single Video Attachment' ),
		'description' => __( 'Template used to display individual videos or attachments.' ),
	];

	return $types;
} );

add_filter( 'block_type_metadata', function( $meta ) {

	//var_dump( $meta );

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
		$meta['supports']['fontSize'] = true;
		$meta['supports']['__experimentalFontStyle'] = true;
		$meta['supports']['lineHeight'] = true;
		$meta['supports']['__experimentalFontFamily'] = true;
		$meta['supports']['__experimentalFontWeight'] = true;
		$meta['supports']['__experimentalTextTransform'] = true;
		$meta['supports']['__experimentalTextDecoration'] = true;
	}

	if ( 'core/heading' === $meta['name'] ) {
		$meta['supports']['__experimentalLetterSpacing'] = true;
	}


	if ( 'core/quote' === $meta['name'] ) {
		$meta['supports']['fontSize'] = true;
		$meta['supports']['lineHeight'] = true;
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

	if ( in_array( $meta['name'], [
		'core/cover',
		'core/group'
	] ) ) {
		//$meta['supports'] = 'align';
		$meta['supports']['lightBlockWrapper'] = true;
	}

	return $meta;
} );

add_filter( 'default_wp_template_part_areas', function( $areas ) {

	$areas[] = [
		'area'        => 'content',
		'label'       => __( 'Content', 'exhale' ),
		'description' => '',
		'icon'        => 'content',
		'area_tag'    => 'div'
	];

	$areas[] = [
		'area'        => 'loop',
		'label'       => __( 'Loop', 'exhale' ),
		'description' => '',
		'icon'        => 'loop',
		'area_tag'    => 'div'
	];

	return $areas;
} );

remove_action( 'admin_menu', 'gutenberg_remove_legacy_pages' );

add_filter( 'the_content', function( $content ) {
	$post = get_post();

	if ( empty( $post->post_type ) || 'attachment' !== $post->post_type || ! is_attachment( $post->ID ) ) {
		return $content;
	}

	$allowed_types = [
		'image',
		'audio',
		'pdf',
		'video'
	];

	foreach ( $allowed_types as $type ) {

		if ( wp_attachment_is( $type, $post ) ) {

			$media = locate_template( "block-template-parts-php/attachment-{$type}-media.php" );
			$meta  = locate_template( "block-template-parts-php/attachment-{$type}-meta.php"  );

			if ( $media ) {
				ob_start();
				include $media;
				$content = ob_get_clean() . wpautop( $content );
			}

			if ( $meta ) {
				ob_start();
				include $meta;
				$content .= ob_get_clean();
			}

			return $content;
		}
	}

	$media = locate_template( "block-template-parts-php/attachment-media.php" );

	if ( $media ) {
		ob_start();
		include $media;
		$content = ob_get_clean() . wpautop( $content );
	}

	return $content;
}, 5 );

/**
 * Filters the excerpt more link.
 *
 * @since  1.0.0
 * @access public
 * @return string
 */
add_filter( 'excerpt_more', function() {

	return ' &hellip;';
} );
