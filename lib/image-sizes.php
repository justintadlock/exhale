<?php
/**
 * Image Sizes Config.
 *
 * Defines the image sizes that the theme sets.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

return [

	// ---------------------------------------------------------------------
	// Landscape Orientation
	// ---------------------------------------------------------------------

	// 16:9

	'exhale-16x9-1k' => [
		'label'  => __( 'Landscape: 16:9 (1K)', 'exhale' ),
		'width'  => 1024,
		'height' => 576
	],

	'exhale-16x9-2k' => [
		'label'       => __( 'Landscape: 16:9 (2K)', 'exhale' ),
		'width'       => 2048,
		'height'      => 1152,
		'is_default'  => true,
		'is_featured' => true
	],

	'exhale-16x9-4k' => [
		'label'  => __( 'Landscape: 16:9 (4K)', 'exhale' ),
		'width'  => 3840,
		'height' => 2160
	],

	// 21:9

	'exhale-21x9-1k' => [
		'label'  => __( 'Landscape: 21:9 (1K)', 'exhale' ),
		'width'  => 1024,
		'height' => 432
	],

	'exhale-21x9-2k' => [
		'label'  => __( 'Landscape: 21:9 (2K)', 'exhale' ),
		'width'  => 2048,
		'height' => 864
	],

	'exhale-21x9-4k' => [
		'label'  => __( 'Landscape: 21:9 (4K)', 'exhale' ),
		'width'  => 3840,
		'height' => 1620
	],

	// 18:5

	'exhale-18x5-1k' => [
		'label'  => __( 'Landscape: 18:5 (1K)', 'exhale' ),
		'width'  => 1024,
		'height' => 284
	],

	'exhale-18x5-2k' => [
		'label'  => __( 'Landscape: 18:5 (2K)', 'exhale' ),
		'width'  => 2048,
		'height' => 569
	],

	'exhale-18x5-4k' => [
		'label'  => __( 'Landscape: 18:5 (4K)', 'exhale' ),
		'width'  => 3840,
		'height' => 1067
	],

	// ---------------------------------------------------------------------
	// Portrait Orientation
	// ---------------------------------------------------------------------

	// 9:16

	'exhale-9x16-1k' => [
		'label'  => __( 'Portrait: 9:16 (1K)', 'exhale' ),
		'width'  => 576,
		'height' => 1024
	],

	'exhale-9x16-2k' => [
		'label'  => __( 'Portrait: 9:16 (2K)', 'exhale' ),
		'width'  => 1152,
		'height' => 2048
	],

	'exhale-9x16-4k' => [
		'label'  => __( 'Portrait: 9:16 (4K)', 'exhale' ),
		'width'  => 2340,
		'height' => 3840
	],

	// 2:3

	'exhale-2x3-1k' => [
		'label'  => __( 'Portrait: 2:3 (1K)', 'exhale' ),
		'width'  => 1024,
		'height' => 1536
	],

	'exhale-2x3-2k' => [
		'label'  => __( 'Portrait: 2:3 (2K)', 'exhale' ),
		'width'  => 2048,
		'height' => 3072
	],

	'exhale-2x3-4k' => [
		'label'  => __( 'Portrait: 2:3 (4K)', 'exhale' ),
		'width'  => 3840,
		'height' => 5760
	],

	// ---------------------------------------------------------------------
	// Square Orientation
	// ---------------------------------------------------------------------

	// 1:1

	'exhale-1x1-1k' => [
		'label'  => __( 'Square: 1:1 (1K)', 'exhale' ),
		'width'  => 1024,
		'height' => 1024
	],

	'exhale-1x1-2k' => [
		'label'  => __( 'Square: 1:1 (2K)', 'exhale' ),
		'width'  => 2048,
		'height' => 2048
	],

	'exhale-1x1-4k' => [
		'label'  => __( 'Square: 1:1 (4K)', 'exhale' ),
		'width'  => 3840,
		'height' => 3840
	]

];
