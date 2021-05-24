<?php
/**
 * Typography Settings Config.
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
		'family'          => 'roboto-condensed',//'roboto',//'system-ui',
		'options'         => [ 'family' ]
	],
	'primary' => [
		'label'           => _x( 'Primary', 'font family setting', 'exhale' ),
		'description'     => __( 'Font used for most of the text on the site.', 'exhale' ),
		'family'          => 'cabin',//'crimson-pro',//'pt-serif',
		'options'         => [ 'family' ]
	],
	'secondary' => [
		'label'           => _x( 'Secondary', 'font family setting', 'exhale' ),
		'description'     => __( 'Font used for secondary, less important text.', 'exhale' ),
		'family'          => 'roboto-condensed',//'roboto',//'system-ui',
		'options'         => [ 'family' ]
	],
	'cursive' => [
		'label' => 'Cursive',
		'description' => '',
		'family' => 'indie-flower',
		'options' => [ 'family' ]
	]
];
