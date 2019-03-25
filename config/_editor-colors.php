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
 */

return [
	'primary' => [
		'color' => \Exhale\Tools\Mod::color( 'primary' ),
		'label' => __( 'Primary' )
	],
	'secondary' => [
		'color' => \Exhale\Tools\Mod::color( 'secondary' ),
		'label' => __( 'Secondary' )
	],
	'black' => [
		'color' => '22292f',
		'label' => __( 'Black' )
	],
	'white' => [
		'color' => 'ffffff',
		'label' => __( 'White' )
	],
	'gray-darkest' => [
		'color' => '3d4852',
		'label' => __( 'Gray: Darkest' )
	],
	'gray-darker' => [
		'color' => '606f7b',
		'label' => __( 'Gray: Darker' )
	],
	'gray-dark' => [
		'color' => '8795a1',
		'label' => __( 'Gray: Dark' )
	],
	'gray' => [
		'color' => 'b8c2cc',
		'label' => __( 'Gray' )
	],
	'gray-light' => [
		'color' => 'dae1e7',
		'label' => __( 'Gray: Light' )
	],
	'gray-lighter' => [
		'color' => 'f1f5f8',
		'label' => __( 'Gray: Lighter' )
	],
	'gray-lightest' => [
		'color' => 'f8fafc',
		'label' => __( 'Gray: Lightest' )
	],
	'red-darkest' => [
		'color' => '3b0d0c',
		'label' => __( 'Red: Darkest' )
	],
	'red-darker' => [
		'color' => '621b18',
		'label' => __( 'Red: Darker' )
	],
	'red-dark' => [
		'color' => 'cc1f1a',
		'label' => __( 'Red: Dark' )
	],
	'red' => [
		'color' => 'e3342f',
		'label' => __( 'Red' )
	],
	'red-light' => [
		'color' => 'ef5753',
		'label' => __( 'Red: Light' )
	],
	'red-lighter' => [
		'color' => 'f9acaa',
		'label' => __( 'Red: Lighter' )
	],
	'red-lightest' => [
		'color' => 'fcebea',
		'label' => __( 'Red: Lightest' )
	],
	'orange-darkest' => [
		'color' => '462a16',
		'label' => __( 'Orange: Darkest' )
	],
	'orange-darker' => [
		'color' => '613b1f',
		'label' => __( 'Orange: Darker' )
	],
	'orange-dark' => [
		'color' => 'de751f',
		'label' => __( 'Orange: Dark' )
	],
	'orange' => [
		'color' => 'f6993f',
		'label' => __( 'Orange' )
	],
	'orange-light' => [
		'color' => 'faad63',
		'label' => __( 'Orange: Light' )
	],
	'orange-lighter' => [
		'color' => 'fcd9b6',
		'label' => __( 'Orange: Lighter' )
	],
	'orange-lightest' => [
		'color' => 'fff5eb',
		'label' => __( 'Orange: Lightest' )
	],
	'yellow-darkest' => [
		'color' => '453411',
		'label' => __( 'Yellow: Darkest' )
	],
	'yellow-darker' => [
		'color' => '684f1d',
		'label' => __( 'Yellow: Darker' )
	],
	'yellow-dark' => [
		'color' => 'f2d024',
		'label' => __( 'Yellow: Dark' )
	],
	'yellow' => [
		'color' => 'ffed4a',
		'label' => __( 'Yellow' )
	],
	'yellow-light' => [
		'color' => 'fff382',
		'label' => __( 'Yellow: Light' )
	],
	'yellow-lighter' => [
		'color' => 'fff9c2',
		'label' => __( 'Yellow: Lighter' )
	],
	'yellow-lightest' => [
		'color' => 'fcfbeb',
		'label' => __( 'Yellow: Lightest' )
	],
	'green-darkest' => [
		'color' => '0f2f21',
		'label' => __( 'Green: Darkest' )
	],
	'green-darker' => [
		'color' => '1a4731',
		'label' => __( 'Green: Darker' )
	],
	'green-dark' => [
		'color' => '1f9d55',
		'label' => __( 'Green: Dark' )
	],
	'green' => [
		'color' => '38c172',
		'label' => __( 'Green' )
	],
	'green-light' => [
		'color' => '51d88a',
		'label' => __( 'Green: Light' )
	],
	'green-lighter' => [
		'color' => 'a2f5bf',
		'label' => __( 'Green: Lighter' )
	],
	'green-lightest' => [
		'color' => 'e3fcec',
		'label' => __( 'Green: Lightest' )
	],
	'teal-darkest' => [
		'color' => '0d3331',
		'label' => __( 'Teal: Darkest' )
	],
	'teal-darker' => [
		'color' => '20504f',
		'label' => __( 'Teal: Darker' )
	],
	'teal-dark' => [
		'color' => '38a89d',
		'label' => __( 'Teal: Dark' )
	],
	'teal' => [
		'color' => '4dc0b5',
		'label' => __( 'Teal' )
	],
	'teal-light' => [
		'color' => '64d5ca',
		'label' => __( 'Teal: Light' )
	],
	'teal-lighter' => [
		'color' => 'a0f0ed',
		'label' => __( 'Teal: Lighter' )
	],
	'teal-lightest' => [
		'color' => 'e8fffe',
		'label' => __( 'Teal: Lightest' )
	],
	'blue-darkest' => [
		'color' => '12283a',
		'label' => __( 'Blue: Darkest' )
	],
	'blue-darker' => [
		'color' => '1c3d5a',
		'label' => __( 'Blue: Darker' )
	],
	'blue-dark' => [
		'color' => '2779bd',
		'label' => __( 'Blue: Dark' )
	],
	'blue' => [
		'color' => '3490dc',
		'label' => __( 'Blue' )
	],
	'blue-light' => [
		'color' => '6cb2eb',
		'label' => __( 'Blue: Light' )
	],
	'blue-lighter' => [
		'color' => 'bcdefa',
		'label' => __( 'Blue: Lighter' )
	],
	'blue-lightest' => [
		'color' => 'eff8ff',
		'label' => __( 'Blue: Lightest' )
	],
	'indigo-darkest' => [
		'color' => '191e38',
		'label' => __( 'Indigo: Darkest' )
	],
	'indigo-darker' => [
		'color' => '2f365f',
		'label' => __( 'Indigo: Darker' )
	],
	'indigo-dark' => [
		'color' => '5661b3',
		'label' => __( 'Indigo: Dark' )
	],
	'indigo' => [
		'color' => '6574cd',
		'label' => __( 'Indigo' )
	],
	'indigo-light' => [
		'color' => '7886d7',
		'label' => __( 'Indigo: Light' )
	],
	'indigo-lighter' => [
		'color' => 'b2b7ff',
		'label' => __( 'Indigo: Lighter' )
	],
	'indigo-lightest' => [
		'color' => 'e6e8ff',
		'label' => __( 'Indigo: Lightest' )
	],
	'purple-darkest' => [
		'color' => '21183c',
		'label' => __( 'Purple: Darkest' )
	],
	'purple-darker' => [
		'color' => '382b5f',
		'label' => __( 'Purple: Darker' )
	],
	'purple-dark' => [
		'color' => '794acf',
		'label' => __( 'Purple: Dark' )
	],
	'purple' => [
		'color' => '9561e2',
		'label' => __( 'Purple' )
	],
	'purple-light' => [
		'color' => 'a779e9',
		'label' => __( 'Purple: Light' )
	],
	'purple-lighter' => [
		'color' => 'd6bbfc',
		'label' => __( 'Purple: Lighter' )
	],
	'purple-lightest' => [
		'color' => 'f3ebff',
		'label' => __( 'Purple: Lightest' )
	],
	'pink-darkest' => [
		'color' => '451225',
		'label' => __( 'Pink: Darkest' )
	],
	'pink-darker' => [
		'color' => '6f213f',
		'label' => __( 'Pink: Darker' )
	],
	'pink-dark' => [
		'color' => 'eb5286',
		'label' => __( 'Pink: Dark' )
	],
	'pink' => [
		'color' => 'f66d9b',
		'label' => __( 'Pink' )
	],
	'pink-light' => [
		'color' => 'fa7ea8',
		'label' => __( 'Pink: Light' )
	],
	'pink-lighter' => [
		'color' => 'ffbbca',
		'label' => __( 'Pink: Lighter' )
	],
	'pink-lightest' => [
		'default'             =>  'ffebef',
		'label' => __( 'Pink: Lightest' )
	]
];
