<?php
/**
 * Loop Layouts Config.
 *
 * Configuration for the theme's loop layouts.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

return [
	'blog' => [
		'label'       => __( 'Blog', 'exhale' ),
		'image_sizes' => [
			'exhale-landscape-medium',
			'exhale-landscape-large',
			'exhale-landscape-extra-large',
			'exhale-landscape-huge',
			'exhale-square-medium'
		]
	],
	'grid' => [
		'label'            => __( 'Grid', 'exhale' ),
		'supports_columns' => true,
		'supports_width'   => true,
		'requires_image'   => true,
		'image_sizes'      => [
			'exhale-landscape-medium',
			'exhale-portrait-small',
			'exhale-portrait-medium',
			'exhale-square-medium'
		]
	],
	'list' => [
		'label'       => __( 'List', 'exhale' ),
		'image_sizes' => []
	]
];
