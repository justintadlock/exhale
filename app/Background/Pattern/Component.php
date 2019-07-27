<?php

namespace Exhale\Background\Pattern;

use Hybrid\Contracts\Bootable;
use Exhale\Settings\Options;
use Exhale\Tools\Config;
use Exhale\Tools\Mod;

/**
 * Clean WP component class.
 *
 * @since  2.2.0
 * @access public
 */
class Component implements Bootable {

	protected $patterns;

	public function __construct( Patterns $patterns ) {
		$this->patterns = $patterns;
	}

	/**
	 * Bootstraps the class' actions/filters.
	 *
	 * @since  2.2.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		add_action( 'after_setup_theme', [ $this, 'registerDefaultPatterns' ] );

		add_filter( 'hybrid/attr/app-header',  [ $this, 'appHeaderAttr'  ]        );
		add_filter( 'hybrid/attr/app-content', [ $this, 'appContentAttr' ]        );
		add_filter( 'hybrid/attr/app-footer',  [ $this, 'appFooterAttr'  ]        );
		add_filter( 'hybrid/attr/sidebar',     [ $this, 'sidebarAttr'    ], 10, 2 );
	}

	public function registerDefaultPatterns() {

		foreach ( Config::get( 'background-patterns' ) as $name => $pattern ) {
			$this->patterns->add( $name, $pattern );
		}
	}

	public function appHeaderAttr( $attr ) {

		$mod = Mod::get( 'header_background_svg' );

		if ( ! $mod ) {
			return $attr;
		}

		$pattern = $this->patterns->get( $mod );

		if ( ! isset( $attr['style'] ) ) {
			$attr['style'] = '';
		}

		//$attr['style'] .= sprintf(
		//	'background-color: #e8eeef;';

		$attr['style'] .= sprintf(
			'background-image: %s;',
			$pattern->cssValue(
				maybe_hash_hex_color( Mod::get( 'color_header_background_fill' ) ),
				floatval( Mod::get( 'header_background_fill_opacity' ) )
			)
		);

		return $attr;
	}

	public function appContentAttr( $attr ) {

		$mod = Mod::get( 'content_background_svg' );

		if ( ! $mod ) {
			return $attr;
		}

		$pattern = $this->patterns->get( $mod );

		if ( ! isset( $attr['style'] ) ) {
			$attr['style'] = '';
		}

		//$attr['style'] .= sprintf(
		//	'background-color: #e8eeef;';

		$attr['style'] .= sprintf(
			'background-image: %s;',
		 	$pattern->cssValue(
				maybe_hash_hex_color( Mod::get( 'color_content_background_fill' ) ),
				floatval( Mod::get( 'content_background_fill_opacity' ) )
			)
		);

		return $attr;
	}

	public function appFooterAttr( $attr ) {

		$mod = Mod::get( 'footer_background_svg' );

		if ( ! $mod ) {
			return $attr;
		}

		$pattern = $this->patterns->get( $mod );

		if ( ! isset( $attr['style'] ) ) {
			$attr['style'] = '';
		}

		//$attr['style'] .= sprintf(
		//	'background-color: #e8eeef;';

		$attr['style'] .= sprintf(
			'background-image: %s;',
			$pattern->cssValue(
				maybe_hash_hex_color( Mod::get( 'color_footer_background_fill' ) ),
				floatval( Mod::get( 'footer_background_fill_opacity' ) )
			)
		);

		return $attr;
	}

	public function sidebarAttr( $attr, $context ) {

		if ( 'footer' !== $context ) {
			return $attr;
		}

		$mod = Mod::get( 'sidebar_footer_background_svg' );

		if ( ! $mod ) {
			return $attr;
		}

		$pattern = $this->patterns->get( $mod );

		if ( ! isset( $attr['style'] ) ) {
			$attr['style'] = '';
		}

		//$attr['style'] .= sprintf(
		//	'background-color: #e8eeef;';

		$attr['style'] .= sprintf(
			'background-image: %s;',
			$pattern->cssValue(
				maybe_hash_hex_color( Mod::get( 'color_sidebar_footer_background_fill' ) ),
				floatval( Mod::get( 'sidebar_footer_background_fill_opacity' ) )
			)
		);

		return $attr;
	}
}
