<?php
/**
 * Base Editor Colors.
 *
 * Overwrite this config in `editor-colors.php`.
 *
 * This file defines the editor color palette naming system.  Out of the box,
 * the theme handles all of the color variations in its CSS.  So, child themes
 * merely need to register their preferred colors following the system.
 *
 * `white`, `black`, `primary`, and `secondary` are the base color names.
 *
 * There are 10 color groups in 7 shades.  The naming convention for colors is:
 * `{$color}-{?$shade}`.
 *
 * The 10 supported color groups are:
 *
 * - gray
 * - red
 * - orange
 * - yellow
 * - green
 * - teal
 * - blue
 * - indigo
 * - purple
 * - pink
 *
 * The 7 shades are:
 *
 * - {$color}-darkest
 * - {$color}-darker
 * - {$color}-dark
 * - {$color}
 * - {$color}-light
 * - {$color}-lighter
 * - {$color}-lightest
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

return [
	'primary' => [
		'label'        => __( 'Primary', 'exhale' ),
		'is_theme_mod' => true
	],
	'secondary' => [
		'label'        => __( 'Secondary', 'exhale' ),
		'is_theme_mod' => true
	],
	'black' => [
		'color' => '22292f',
		'label' => __( 'Black', 'exhale' )
	],
	'white' => [
		'color' => 'ffffff',
		'label' => __( 'White', 'exhale' )
	],
	'gray-darkest' => [
		'color' => '3d4852',
		'label' => __( 'Gray: Darkest', 'exhale' )
	],
	'gray-darker' => [
		'color' => '606f7b',
		'label' => __( 'Gray: Darker', 'exhale' )
	],
	'gray-dark' => [
		'color' => '8795a1',
		'label' => __( 'Gray: Dark', 'exhale' )
	],
	'gray' => [
		'color' => 'b8c2cc',
		'label' => __( 'Gray', 'exhale' )
	],
	'gray-light' => [
		'color' => 'dae1e7',
		'label' => __( 'Gray: Light', 'exhale' )
	],
	'gray-lighter' => [
		'color' => 'f1f5f8',
		'label' => __( 'Gray: Lighter', 'exhale' )
	],
	'gray-lightest' => [
		'color' => 'f8fafc',
		'label' => __( 'Gray: Lightest', 'exhale' )
	],
	'red-darkest' => [
		'color' => '3b0d0c',
		'label' => __( 'Red: Darkest', 'exhale' )
	],
	'red-darker' => [
		'color' => '621b18',
		'label' => __( 'Red: Darker', 'exhale' )
	],
	'red-dark' => [
		'color' => 'cc1f1a',
		'label' => __( 'Red: Dark', 'exhale' )
	],
	'red' => [
		'color' => 'e3342f',
		'label' => __( 'Red', 'exhale' )
	],
	'red-light' => [
		'color' => 'ef5753',
		'label' => __( 'Red: Light', 'exhale' )
	],
	'red-lighter' => [
		'color' => 'f9acaa',
		'label' => __( 'Red: Lighter', 'exhale' )
	],
	'red-lightest' => [
		'color' => 'fcebea',
		'label' => __( 'Red: Lightest', 'exhale' )
	],
	'orange-darkest' => [
		'color' => '462a16',
		'label' => __( 'Orange: Darkest', 'exhale' )
	],
	'orange-darker' => [
		'color' => '613b1f',
		'label' => __( 'Orange: Darker', 'exhale' )
	],
	'orange-dark' => [
		'color' => 'de751f',
		'label' => __( 'Orange: Dark', 'exhale' )
	],
	'orange' => [
		'color' => 'f6993f',
		'label' => __( 'Orange', 'exhale' )
	],
	'orange-light' => [
		'color' => 'faad63',
		'label' => __( 'Orange: Light', 'exhale' )
	],
	'orange-lighter' => [
		'color' => 'fcd9b6',
		'label' => __( 'Orange: Lighter', 'exhale' )
	],
	'orange-lightest' => [
		'color' => 'fff5eb',
		'label' => __( 'Orange: Lightest', 'exhale' )
	],
	'yellow-darkest' => [
		'color' => '453411',
		'label' => __( 'Yellow: Darkest', 'exhale' )
	],
	'yellow-darker' => [
		'color' => '684f1d',
		'label' => __( 'Yellow: Darker', 'exhale' )
	],
	'yellow-dark' => [
		'color' => 'f2d024',
		'label' => __( 'Yellow: Dark', 'exhale' )
	],
	'yellow' => [
		'color' => 'ffed4a',
		'label' => __( 'Yellow', 'exhale' )
	],
	'yellow-light' => [
		'color' => 'fff382',
		'label' => __( 'Yellow: Light', 'exhale' )
	],
	'yellow-lighter' => [
		'color' => 'fff9c2',
		'label' => __( 'Yellow: Lighter', 'exhale' )
	],
	'yellow-lightest' => [
		'color' => 'fcfbeb',
		'label' => __( 'Yellow: Lightest', 'exhale' )
	],
	'green-darkest' => [
		'color' => '0f2f21',
		'label' => __( 'Green: Darkest', 'exhale' )
	],
	'green-darker' => [
		'color' => '1a4731',
		'label' => __( 'Green: Darker', 'exhale' )
	],
	'green-dark' => [
		'color' => '1f9d55',
		'label' => __( 'Green: Dark', 'exhale' )
	],
	'green' => [
		'color' => '38c172',
		'label' => __( 'Green', 'exhale' )
	],
	'green-light' => [
		'color' => '51d88a',
		'label' => __( 'Green: Light', 'exhale' )
	],
	'green-lighter' => [
		'color' => 'a2f5bf',
		'label' => __( 'Green: Lighter', 'exhale' )
	],
	'green-lightest' => [
		'color' => 'e3fcec',
		'label' => __( 'Green: Lightest', 'exhale' )
	],
	'teal-darkest' => [
		'color' => '0d3331',
		'label' => __( 'Teal: Darkest', 'exhale' )
	],
	'teal-darker' => [
		'color' => '20504f',
		'label' => __( 'Teal: Darker', 'exhale' )
	],
	'teal-dark' => [
		'color' => '38a89d',
		'label' => __( 'Teal: Dark', 'exhale' )
	],
	'teal' => [
		'color' => '4dc0b5',
		'label' => __( 'Teal', 'exhale' )
	],
	'teal-light' => [
		'color' => '64d5ca',
		'label' => __( 'Teal: Light', 'exhale' )
	],
	'teal-lighter' => [
		'color' => 'a0f0ed',
		'label' => __( 'Teal: Lighter', 'exhale' )
	],
	'teal-lightest' => [
		'color' => 'e8fffe',
		'label' => __( 'Teal: Lightest', 'exhale' )
	],
	'blue-darkest' => [
		'color' => '12283a',
		'label' => __( 'Blue: Darkest', 'exhale' )
	],
	'blue-darker' => [
		'color' => '1c3d5a',
		'label' => __( 'Blue: Darker', 'exhale' )
	],
	'blue-dark' => [
		'color' => '2779bd',
		'label' => __( 'Blue: Dark', 'exhale' )
	],
	'blue' => [
		'color' => '3490dc',
		'label' => __( 'Blue', 'exhale' )
	],
	'blue-light' => [
		'color' => '6cb2eb',
		'label' => __( 'Blue: Light', 'exhale' )
	],
	'blue-lighter' => [
		'color' => 'bcdefa',
		'label' => __( 'Blue: Lighter', 'exhale' )
	],
	'blue-lightest' => [
		'color' => 'eff8ff',
		'label' => __( 'Blue: Lightest', 'exhale' )
	],
	'indigo-darkest' => [
		'color' => '191e38',
		'label' => __( 'Indigo: Darkest', 'exhale' )
	],
	'indigo-darker' => [
		'color' => '2f365f',
		'label' => __( 'Indigo: Darker', 'exhale' )
	],
	'indigo-dark' => [
		'color' => '5661b3',
		'label' => __( 'Indigo: Dark', 'exhale' )
	],
	'indigo' => [
		'color' => '6574cd',
		'label' => __( 'Indigo', 'exhale' )
	],
	'indigo-light' => [
		'color' => '7886d7',
		'label' => __( 'Indigo: Light', 'exhale' )
	],
	'indigo-lighter' => [
		'color' => 'b2b7ff',
		'label' => __( 'Indigo: Lighter', 'exhale' )
	],
	'indigo-lightest' => [
		'color' => 'e6e8ff',
		'label' => __( 'Indigo: Lightest', 'exhale' )
	],
	'purple-darkest' => [
		'color' => '21183c',
		'label' => __( 'Purple: Darkest', 'exhale' )
	],
	'purple-darker' => [
		'color' => '382b5f',
		'label' => __( 'Purple: Darker', 'exhale' )
	],
	'purple-dark' => [
		'color' => '794acf',
		'label' => __( 'Purple: Dark', 'exhale' )
	],
	'purple' => [
		'color' => '9561e2',
		'label' => __( 'Purple', 'exhale' )
	],
	'purple-light' => [
		'color' => 'a779e9',
		'label' => __( 'Purple: Light', 'exhale' )
	],
	'purple-lighter' => [
		'color' => 'd6bbfc',
		'label' => __( 'Purple: Lighter', 'exhale' )
	],
	'purple-lightest' => [
		'color' => 'f3ebff',
		'label' => __( 'Purple: Lightest', 'exhale' )
	],
	'pink-darkest' => [
		'color' => '451225',
		'label' => __( 'Pink: Darkest', 'exhale' )
	],
	'pink-darker' => [
		'color' => '6f213f',
		'label' => __( 'Pink: Darker', 'exhale' )
	],
	'pink-dark' => [
		'color' => 'eb5286',
		'label' => __( 'Pink: Dark', 'exhale' )
	],
	'pink' => [
		'color' => 'f66d9b',
		'label' => __( 'Pink', 'exhale' )
	],
	'pink-light' => [
		'color' => 'fa7ea8',
		'label' => __( 'Pink: Light', 'exhale' )
	],
	'pink-lighter' => [
		'color' => 'ffbbca',
		'label' => __( 'Pink: Lighter', 'exhale' )
	],
	'pink-lightest' => [
		'color' =>  'ffebef',
		'label' => __( 'Pink: Lightest', 'exhale' )
	]
];
