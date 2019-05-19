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
		'description' => __( 'Background color used for content of the site.', 'exhale' )
	],
	'primary' => [
		'color'       => '687d81',
		'label'       => __( 'Primary: Text', 'exhale' ),
		'description' => __( 'Color used for most text on the site.', 'exhale' )
	],
	'primary-link' => [
		'color'       => 'e3342f',
		'label'       => __( 'Primary: Link', 'exhale' ),
		'description' => __( 'Color used for links in primary text.', 'exhale' )
	],
	'primary-link-hover' => [
		'color'       => '222222',
		'label'       => __( 'Primary: Link Hover', 'exhale' ),
		'description' => __( 'Color used when hovering or focusing a link.', 'exhale' )
	],
	'secondary' => [
		'color'       => 'a9a9a9',
		'label'       => __( 'Secondary: Text', 'exhale' ),
		'description' => __( 'Color used for secondary text.', 'exhale' )
	],
	'secondary-link' => [
		'color'           => 'a9a9a9',
		'label'           => __( 'Secondary: Link', 'exhale' ),
		'description'     => __( 'Color used for links in secondary text.', 'exhale' )
	],
	'secondary-link-hover' => [
		'color'           => '222222',
		'label'           => __( 'Secondary: Link Hover', 'exhale' ),
		'description'     => __( 'Color used when hovering or focusing a link.', 'exhale' )
	],
	'headings' => [
		'color'           => '222222',
		'label'           => __( 'Headings', 'exhale' ),
		'description'     => __( 'Color used for text headings.', 'exhale' )
	],
	'header-background' => [
		'color'           => 'fcfcfc',
		'label'           => __( 'Header: Background', 'exhale' ),
		'description'     => __( 'Background color for the entire header block.', 'exhale' )
	],
	'header-border' => [
		'color'           => 'f3f3f3',
		'label'           => __( 'Header: Border', 'exhale' ),
		'description'     => __( 'Color used for borders in the header.', 'exhale' )
	],
	'branding-background' => [
		'color'           => 'fcfcfc',
		'label'           => __( 'Header: Branding Background', 'exhale' ),
		'description'     => __( 'Background color for the branding area.', 'exhale' ),
	],
	'header-title' => [
		'color'           => '757575',
		'label'           => __( 'Header: Title Text', 'exhale' ),
		'description'     => __( 'Color for the branding title text.', 'exhale' ),
	],
	'header-title-hover' => [
		'color'           => '222222',
		'label'           => __( 'Header: Title Text Hover', 'exhale' ),
		'description'     => __( 'Color used when hovering or focusing a link.', 'exhale' )
	],
	'header-description' => [
		'color'           => '959595',
		'label'           => __( 'Header: Tagline Text', 'exhale' ),
		'description'     => __( 'Color used for the branding tagline text.', 'exhale' )
	],
	'menu-primary' => [
		'color'           => '959595',
		'label'           => __( 'Header: Menu Link', 'exhale' ),
		'description'     => __( 'Color for the primary menu links.', 'exhale' ),
	],
	'menu-primary-hover' => [
		'color'           => '222222',
		'label'           => __( 'Header: Menu Link Hover', 'exhale' ),
		'description'     => __( 'Color used when hovering or focusing a link.', 'exhale' )
	],
	'footer' => [
		'label'           => __( 'Footer: Text', 'exhale' ),
		'description'     => __( 'Color used for most text in the footer.', 'exhale' ),
		'color'           => function() {
			return \Exhale\Tools\Mod::color( 'secondary' );
		}
	],
	'footer-background' => [
		'label'           => __( 'Footer: Background', 'exhale' ),
		'description'     => __( 'Background color for the entire footer section.', 'exhale' ),
		'color'           => function() {
			return \Exhale\Tools\Mod::color( 'header-background' );
		}
	],
	'footer-border' => [
		'color'           => '',
		'label'           => __( 'Footer: Border', 'exhale' ),
		'description'     => __( 'Color used for borders in the footer.', 'exhale' )
	],
	'footer-link' => [
		'label'           => __( 'Footer: Link', 'exhale' ),
		'description'     => __( 'Color for the links in the footer.', 'exhale' ),
		'color'           => function() {
			return \Exhale\Tools\Mod::color( 'secondary-link' );
		}
	],
	'footer-link-hover' => [
		'label'           => __( 'Footer: Link Hover', 'exhale' ),
		'description'     => __( 'Color used when hovering or focusing a link.', 'exhale' ),
		'color'           => function() {
			return \Exhale\Tools\Mod::color( 'secondary-link-hover' );
		}
	],
	'border' => [
		'color'           => 'e1e1e1',
		'label'           => __( 'Border', 'exhale' ),
		'description'     => __( 'Color used for borders in general.', 'exhale' ),
	]
];
