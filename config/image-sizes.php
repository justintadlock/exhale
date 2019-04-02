<?php
/**
 * Image Sizes Config.
 *
 * Defines the image sizes that the theme sets.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

return [
	'post-thumbnail' => [
		'label'            => __( 'Theme: Thumbnail', 'exhale' ),
		'width'            => 178,
		'height'           => 100,
		'is_featured_size' => false
	],
	'exhale-medium' => [
		'label'  => __( 'Theme: Medium', 'exhale' ),
		'width'  => 650,
		'height' => 366
	],
	'exhale-wide' => [
		'label'  => __( 'Theme: Wide', 'exhale' ),
		'width'  => 900,
		'height' => 506
	],
	'exhale-wider' => [
		'label'  => __( 'Theme: Wider', 'exhale' ),
		'width'  => 1366,
		'height' => 768
	],
	'exhale-widest' => [
		'label'  => __( 'Theme: Widest', 'exhale' ),
		'width'  => 1920,
		'height' => 1080
	]
];
