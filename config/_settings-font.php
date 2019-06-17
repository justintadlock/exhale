<?php
/**
 * Customize Font Config.
 *
 * Defines the font options available in the customizer.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

return [
	'headings' => [
		'label'           => _x( 'Headings', 'font family setting', 'exhale' ),
		'description'     => __( 'Font used for text headings.', 'exhale' ),
		'family'          => 'system-ui',
		'style'           => '700',
		'options'         => [ 'family', 'style' ]
	],
	'primary' => [
		'label'           => _x( 'Primary', 'font family setting', 'exhale' ),
		'description'     => __( 'Font used for most of the text on the site.', 'exhale' ),
		'family'          => 'georgia',
		'options'         => [ 'family' ],
		'required_styles' => [ '400', '400i', '700', '700i' ]
	],
	'secondary' => [
		'label'           => _x( 'Secondary', 'font family setting', 'exhale' ),
		'description'     => __( 'Font used for secondary, less important text.', 'exhale' ),
		'family'          => 'system-ui',
		'options'         => [ 'family' ],
		'required_styles' => [ '400', '400i', '700', '700i' ]
	]
];
