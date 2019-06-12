<?php
/**
 * Theme mods settings Config.
 *
 * Defines the default theme mods for the theme. Child themes can overwrite this
 * with a `config/settings-mod.php` file for changing the defaults.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

return [
	// Set the default layout.
	'layout' => 'wide',

	// Set the default featured image size.
	'featured_image_size' => 'exhale-landscape-large',

	// Set the default image filter mods.
	'image_default_filter_function' => 'grayscale',
	'image_default_filter_amount'   => 0,
	'image_hover_filter_amount'     => 100,

	// Set the default footer credit.
	'powered_by'    => true,
	'footer_credit' => function() {
		return sprintf( __( 'Powered by %s.', 'exhale' ), \Hybrid\Theme\render_link() );
	}
];
