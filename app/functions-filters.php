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

add_filter( 'post_thumbnail_size', function( $size ) {
	return 'exhale-landscape-extra-large';
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
