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

	// Archive layout.
	'loop_archive_layout'     => 'list',
	'loop_archive_limit'      => 10,
	'loop_archive_width'      => 'full',
	'loop_archive_columns'    => 4,
	'loop_archive_image_size' => 'exhale-landscape-large',
	'loop_archive_limit'      => function() {
		return \Exhale\Settings\Options::get( 'archive_posts_number' );
	},

	// Blog layout.
	'loop_blog_layout'     => 'default',
	'loop_blog_width'      => 'full',
	'loop_blog_columns'    => 4,
	'loop_blog_image_size' => function() {
		return \Exhale\Tools\Mod::get( 'featured_image_size' );
	},
	'loop_blog_limit'      => function() {
		return \Exhale\Settings\Options::get( 'home_posts_number' );
	},

	// Footer sidebar layout.
	'sidebar_footer_width'   => 'full',
	'sidebar_footer_columns' => 3,           // 1, 2, 3, 4

	// Set the default featured image size.
	'featured_image_size' => 'exhale-landscape-extra-large',

	// Set the default image filter mods.
	'image_default_filter_function' => 'grayscale',
	'image_default_filter_amount'   => 0,
	'image_hover_filter_amount'     => 100,

	// Set the default footer credit.
	'powered_by'    => true,
	'footer_credit' => function() {
		return sprintf( __( 'Powered by %s.', 'exhale' ), \Hybrid\Theme\render_link() );
	},

	// @deprecated 2.1.0
	'featured_image_size' => 'exhale-landscape-extra-large',
];
