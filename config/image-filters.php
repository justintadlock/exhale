<?php
/**
 * Image Filters Config.
 *
 * Defines the image filters available for users with the image filter feature
 * in the customizer.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

return [
	'none' => [
		'label' => __( 'None', 'exhale' )
	],
	'brightness' => [
		'label'   => __( 'Brightness', 'exhale' ),
		'min'     => 0,
		'max'     => 200,
		'lacuna'  => 100
	],
	'contrast' => [
		'label'  => __( 'Contrast', 'exhale' ),
		'min'    => 0,
		'max'    => 200,
		'lacuna' => 100
	],
	'grayscale' => [
		'label'  => __( 'Grayscale', 'exhale' ),
		'min'    => 0,
		'max'    => 100,
		'lacuna' => 0
	],
	'invert' => [
		'label'  => __( 'Invert', 'exhale' ),
		'min'    => 0,
		'max'    => 100,
		'lacuna' => 0
	],
	'opacity' => [
		'label'  => __( 'Opacity', 'exhale' ),
		'min'    => 0,
		'max'    => 100,
		'lacuna' => 100
	],
	'saturate' => [
		'label'  => __( 'Saturate', 'exhale' ),
		'min'    => 0,
		'max'    => 200,
		'lacuna' => 100
	],
	'sepia' => [
		'label'  => __( 'Sepia', 'exhale' ),
		'min'    => 0,
		'max'    => 100,
		'lacuna' => 0
	]
];
