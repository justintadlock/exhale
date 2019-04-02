<?php
/**
 * Font Family Settings Config.
 *
 * Defines the font family settings available to users in the customizer.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

return [
	'primary' => [
		'label'       => _x( 'Primary', 'font family setting' ),
		'description' => __( 'Font used for most of the text on the site.' ),
		'family'      => 'georgia'
	],
	'secondary' => [
		'label'       => _x( 'Secondary', 'font family setting' ),
		'description' => __( 'Font used for secondary, less important text.' ),
		'family'      => 'system-ui',
	],
	'headings' => [
		'label'       => _x( 'Headings', 'font family setting' ),
		'description' => __( 'Font used for text headings.' ),
		'family'      => 'system-ui'
	]
];
