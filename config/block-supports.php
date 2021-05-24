<?php
return [
	'core/button' => [
		'fontSize' => true,
		'__experimentalFontStyle' => true,
		'lineHeight' => true,
		'__experimentalFontFamily'] = true;
		$meta['supports']['__experimentalFontWeight'] = true;
		$meta['supports']['__experimentalTextTransform'] = true;
		$meta['supports']['__experimentalTextDecoration'] = true;
	],
	'core/buttons' => [
	],
	'core/code' => [
	],
	'core/column' => [
	],
	'core/columns' => [
	],
	'core/cover' => [
	],
	'core/group' => [
	],
	'core/heading' => [
	],
	'core/image' => [
	],
	'core/list' => [
	],
	'core/media-text' => [
	],
	'core/navigation' => [
	],
	'core/quote' => [
	],
	'core/paragraph' => [
	],
	'core/post-author' => [
	],
	'core/post-comments-link' => [
	],
	'core/post-content' => [
	],
	'core/post-date' => [
	],
	'core/post-excerpt' => [
	],
	'core/post-featured-image' => [
	],
	'core/post-terms' => [
	],
	'core/post-title' => [
	],
	'core/separator' => [
	],
	'core/social-links' => [
	],
	'core/site-title' => [
	],
	'core/term-description' => [
	],
];


if ( in_array( $meta['name'], [
	'core/button',
	'core/code',
	'core/column',
	'core/columns',
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
//	var_dump( $meta );
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
	$meta['supports']['spacing']['margin'] = [
		'top' => true,
		'bottom' => true,
		'left' => false,
		'right' => false
	];
}

if ( in_array( $meta['name'], [
	'core/code',
	'core/columns',
	'core/column',
	'core/list',
	'core/media-text',
	'core/navigaiton',
	'core/paragraph',
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

	$meta['supports']['spacing']['margin'] = [
		'top' => true,
		'bottom' => true,
		'left' => false,
		'right' => false
	];
}
