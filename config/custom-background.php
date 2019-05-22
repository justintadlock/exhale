<?php
/**
 * Custom Background Config.
 *
 * Configuration for the core WordPress `custom-background` theme feature.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

return [
	'default-image'          => '',
	'default-preset'         => 'default',
	'default-position-x'     => 'left',
	'default-position-y'     => 'top',
	'default-size'           => 'auto',
	'default-repeat'         => 'repeat',
	'default-attachment'     => 'scroll',
	// Falls back to the `content-backgound` color for pre-1.2.0 compat.
	'default-color'          => is_child_theme()
	                            ? \Exhale\Tools\Mod::color( 'content-background', 'ffffff' )
				    : 'f3f3f3'
];
