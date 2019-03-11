<?php

namespace Exhale\Color;

use Hybrid\Tools\Collection;

use function Hybrid\hex_to_rgb;

class Settings extends Collection {

	public function add( $name, $value ) {

		parent::add( $name, new Setting( $name, $value ) );
	}

	public function customizeToJson() {

		$colors = [];

		foreach ( $this->all() as $color ) {

			if ( ! $color->isCustomizerColor() ) {
				continue;
			}

			$colors[] = [
				'modName' => $color->modName(),
				'property' => sprintf( '--color-%s', $color->name() )
			];
		}

		return $colors;
	}

	public function editorPalette() {

		$palette = [];

		foreach ( $this->editorColors() as $setting ) {
			$palette[] = [
				'name'  => $setting->label(),
				'slug'  => $setting->name(),
				'color' => $setting->hex()
			];
		}

		return $palette;
	}

	public function editorColors() {

		$colors = [];

		foreach ( $this->all() as $color ) {
			if ( $color->isEditorColor() ) {
				$colors[] = $color;
			}
		}

		return $this->sort( $colors );
	}

	public function customizeColors() {

		$colors = [];

		foreach ( $this->all() as $color ) {
			if ( $color->isCustomizerColor() ) {
				$colors[] = $color;
			}
		}

		return $colors;
	}

	public function sort( array $colors = [] ) {

		$colors = $colors ?: $this->all();

		usort( $colors, function( $a, $b ) {
			$a_rgb = $a->rgb();
			$b_rgb = $b->rgb();

			if ( ( $a_rgb['r'] + $a_rgb['g'] + $a_rgb['b'] ) > ( $b_rgb['r'] + $b_rgb['g'] + $b_rgb['b'] ) ) {
				return 1;
			}

			return -1;
		} );

		return $colors;
	}
}
