<?php
/**
 * Image Filters Config.
 *
 * Defines the image filters available for users with the image filter feature
 * in the customizer.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

return [
	'none' => [
		'label' => __( 'None' )
	],
	'brightness' => [
		'label'   => __( 'Brightness' ),
		'min'     => 0,
		'max'     => 200,
		'lacuna'  => 100
	],
	'contrast' => [
		'label'  => __( 'Contrast' ),
		'min'    => 0,
		'max'    => 200,
		'lacuna' => 100
	],
	'grayscale' => [
		'label'  => __( 'Grayscale' ),
		'min'    => 0,
		'max'    => 100,
		'lacuna' => 0
	],
	'invert' => [
		'label'  => __( 'Invert' ),
		'min'    => 0,
		'max'    => 100,
		'lacuna' => 0
	],
	'opacity' => [
		'label'  => __( 'Opacity' ),
		'min'    => 0,
		'max'    => 100,
		'lacuna' => 100
	],
	'saturate' => [
		'label'  => __( 'Saturate' ),
		'min'    => 0,
		'max'    => 200,
		'lacuna' => 100
	],
	'sepia' => [
		'label'  => __( 'Sepia' ),
		'min'    => 0,
		'max'    => 100,
		'lacuna' => 0
	]
];
