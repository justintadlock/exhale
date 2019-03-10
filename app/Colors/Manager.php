<?php

namespace Exhale\Colors;

use Hybrid\Contracts\Bootable;

class Manager implements Bootable {

	protected $colors;

	public function __construct( Colors $colors ) {

		$this->colors = $colors;
	}

	public function boot() {

		add_action( 'after_setup_theme', [ $this, 'addThemeSupport' ] );

		add_action( 'extant/colors/register', [ $this, 'registerDefaultColors'] );
	}

	public function addThemeSupport() {

		do_action( 'extant/colors/register', $this->colors );

		$palette = [];

		foreach ( $this->colors->editorColors() as $color ) {
			$palette[] = [
				'name'  => $color->label(),
				'slug'  => $color->name(),
				'color' => $color->hex()
			];
		}

		// Editor color palette.
		add_theme_support( 'editor-color-palette', $palette );
	}

	public function registerDefaultColors( $colors ) {

		$_colors = include( 'color-definitions.php' );

		foreach ( $_colors as $name => $options ) {
			$colors->add( $name, $options );
		}
	}
}
