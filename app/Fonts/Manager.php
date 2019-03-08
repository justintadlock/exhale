<?php

namespace Exhale\Fonts;

use Hybrid\Contracts\Bootable;

class Manager implements Bootable {

	protected $families;

	public function __construct( Families $families ) {

		$this->families = $families;
	}

	public function boot() {

		add_action( 'init', [ $this, 'addThemeSupport' ] );

		add_action( 'extant/font/family/register', [ $this, 'registerDefaultFonts'] );
	}

	public function addThemeSupport() {

		do_action( 'extant/font/family/register', $this->families );
	}

	public function registerDefaultFonts( $families ) {

		$fonts = include( 'font-definitions.php' );

		foreach ( $fonts as $name => $args ) {
			$this->families->add( $name, $args );
		}

	}

	public function familyInlineStyle() {

		$style = '';

		$fonts = [
			'primary'   => get_theme_mod( 'font_family_primary',   'georgia'   ),
			'secondary' => get_theme_mod( 'font_family_secondary', 'system-ui' ),
			'headings'  => get_theme_mod( 'font_family_headings',  'system-ui' )
		];

		foreach ( $fonts as $font => $mod ) {
			$style .= sprintf(
				'--font-family-%s: %s;',
				$font,
				$this->families->get( $mod )->stack()
			);
		}

		return ":root { {$style} }";
	}
}
