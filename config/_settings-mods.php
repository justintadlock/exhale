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
	'layout'         => 'wide',

	// Content layout.
	'loop_archive_layout'     => 'list',
	'loop_archive_limit'      => 10,
	'loop_archive_width'      => 'full',
	'loop_archive_columns'    => 4,
	'loop_archive_image_size' => 'exhale-landscape-large',

	'loop_blog_layout'     => 'grid',
	'loop_blog_limit'      => 10,
	'loop_blog_width'      => 'full',
	'loop_blog_columns'    => 4,
	'loop_blog_image_size' => 'exhale-landscape-large',


	'featured_image_size' => 'exhale-landscape-extra-large',
	/*
	'content_layout'        => 'grid',
	'content_layout_home'   => function() {
		return \Exhale\Tools\Mod::get( 'content_layout' );
	},
	'content_layout_archive' => function() {
		return \Exhale\Tools\Mod::get( 'content_layout' );
	},

	'posts_per_page' => 10,

	'content_layout_width'         => 'full',
	'content_layout_home_width'    => function() {
		return \Exhale\Tools\Mod::get( 'content_layout_width' );
	},
	'content_layout_archive_width' => function() {
		return \Exhale\Tools\Mod::get( 'content_layout_width' );
	},

	'content_layout_columns'         => 4,
	'content_layout_home_columns'    => function() {
		return \Exhale\Tools\Mod::get( 'content_layout_columns' );
	},
	'content_layout_archive_columns' => function() {
		return \Exhale\Tools\Mod::get( 'content_layout_columns' );
	},
	*/

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
	}
];
