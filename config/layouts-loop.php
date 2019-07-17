<?php

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
