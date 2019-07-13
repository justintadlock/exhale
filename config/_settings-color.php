<?php
/**
 * Customize Colors Config.
 *
 * Defines the color options available in the WordPress customizer.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

return [
	'content-background' => [
		'color'       => 'ffffff',
		'label'       => __( 'Content Background', 'exhale' ),
		'description' => __( 'Background color used for content of the site.', 'exhale' ),
		'section'     => 'theme_content_colors'
	],
	'primary' => [
		'color'       => '687d81',
		'label'       => __( 'Primary: Text', 'exhale' ),
		'description' => __( 'Color used for most text on the site.', 'exhale' ),
		'section'         => 'theme_content_colors'
	],
	'primary-link' => [
		'color'       => 'e3342f',
		'label'       => __( 'Primary: Link', 'exhale' ),
		'description' => __( 'Color used for links in primary text.', 'exhale' ),
		'section'         => 'theme_content_colors'
	],
	'primary-link-hover' => [
		'color'       => '222222',
		'label'       => __( 'Primary: Link Hover', 'exhale' ),
		'description' => __( 'Color used when hovering or focusing a link.', 'exhale' ),
		'section'         => 'theme_content_colors'
	],
	'secondary' => [
		'color'       => 'a9a9a9',
		'label'       => __( 'Secondary: Text', 'exhale' ),
		'description' => __( 'Color used for secondary text.', 'exhale' ),
		'section'         => 'theme_content_colors'
	],
	'secondary-link' => [
		'color'           => 'a9a9a9',
		'label'           => __( 'Secondary: Link', 'exhale' ),
		'description'     => __( 'Color used for links in secondary text.', 'exhale' ),
		'section'         => 'theme_content_colors'
	],
	'secondary-link-hover' => [
		'color'           => '222222',
		'label'           => __( 'Secondary: Link Hover', 'exhale' ),
		'description'     => __( 'Color used when hovering or focusing a link.', 'exhale' ),
		'section'         => 'theme_content_colors'
	],
	'headings' => [
		'color'           => '222222',
		'label'           => __( 'Headings', 'exhale' ),
		'description'     => __( 'Color used for text headings.', 'exhale' ),
		'section'         => 'theme_content_colors'
	],
	'header-background' => [
		'color'           => 'fcfcfc',
		'label'           => __( 'Header: Background', 'exhale' ),
		'description'     => __( 'Background color for the entire header block.', 'exhale' ),
		'section'         => 'theme_header_colors'
	],
	'header-border' => [
		'color'           => 'f3f3f3',
		'label'           => __( 'Header: Border', 'exhale' ),
		'description'     => __( 'Color used for borders in the header.', 'exhale' ),
		'section'         => 'theme_header_colors'
	],
	'branding-background' => [
		'color'           => 'fcfcfc',
		'label'           => __( 'Header: Branding Background', 'exhale' ),
		'description'     => __( 'Background color for the branding area.', 'exhale' ),
		'section'         => 'theme_header_colors'
	],
	'header-title' => [
		'color'           => '757575',
		'label'           => __( 'Header: Title Text', 'exhale' ),
		'description'     => __( 'Color for the branding title text.', 'exhale' ),
		'section'         => 'theme_header_colors'
	],
	'header-title-hover' => [
		'color'           => '222222',
		'label'           => __( 'Header: Title Text Hover', 'exhale' ),
		'description'     => __( 'Color used when hovering or focusing a link.', 'exhale' ),
		'section'         => 'theme_header_colors'
	],
	'header-description' => [
		'color'           => '959595',
		'label'           => __( 'Header: Tagline Text', 'exhale' ),
		'description'     => __( 'Color used for the branding tagline text.', 'exhale' ),
		'section'         => 'theme_header_colors'
	],
	'menu-primary' => [
		'color'           => '959595',
		'label'           => __( 'Header: Menu Link', 'exhale' ),
		'description'     => __( 'Color for the primary menu links.', 'exhale' ),
		'section'         => 'theme_header_colors'
	],
	'menu-primary-hover' => [
		'color'           => '222222',
		'label'           => __( 'Header: Menu Link Hover', 'exhale' ),
		'description'     => __( 'Color used when hovering or focusing a link.', 'exhale' ),
		'section'         => 'theme_header_colors'
	],
	'footer' => [
		'label'           => __( 'Footer: Text', 'exhale' ),
		'description'     => __( 'Color used for most text in the footer.', 'exhale' ),
		'color'           => function() {
			return \Exhale\Tools\Mod::color( 'secondary' );
		},
		'section'         => 'theme_footer_colors'
	],
	'footer-background' => [
		'label'           => __( 'Footer: Background', 'exhale' ),
		'description'     => __( 'Background color for the entire footer section.', 'exhale' ),
		'color'           => function() {
			return \Exhale\Tools\Mod::color( 'header-background' );
		},
		'section'         => 'theme_footer_colors'
	],
	'footer-border' => [
		'color'           => '',
		'label'           => __( 'Footer: Border', 'exhale' ),
		'description'     => __( 'Color used for borders in the footer.', 'exhale' ),
		'section'         => 'theme_footer_colors'
	],
	'footer-link' => [
		'label'           => __( 'Footer: Link', 'exhale' ),
		'description'     => __( 'Color for the links in the footer.', 'exhale' ),
		'color'           => function() {
			return \Exhale\Tools\Mod::color( 'secondary-link' );
		},
		'section'         => 'theme_footer_colors'
	],
	'footer-link-hover' => [
		'label'           => __( 'Footer: Link Hover', 'exhale' ),
		'description'     => __( 'Color used when hovering or focusing a link.', 'exhale' ),
		'color'           => function() {
			return \Exhale\Tools\Mod::color( 'secondary-link-hover' );
		},
		'section'         => 'theme_footer_colors'
	],
	'border' => [
		'color'           => 'e1e1e1',
		'label'           => __( 'Border', 'exhale' ),
		'description'     => __( 'Color used for borders in general.', 'exhale' ),
		'section'         => 'theme_content_colors'
	]
];
