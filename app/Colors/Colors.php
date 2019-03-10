<?php

namespace Exhale\Colors;

use Hybrid\Tools\Collection;

use function Hybrid\hex_to_rgb;

class Colors extends Collection {

	public function add( $name, $value ) {

		parent::add( $name, new Color( $name, $value ) );
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

	public function editorColors() {

		$colors = [];

		foreach ( $this->all() as $color ) {
			if ( $color->isEditorColor() ) {
				$colors[] = $color;
			}
		}

		return $this->sort( $colors );
	}

	public function customizerColors() {

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

	public function inlineStyle() {

		$css = '';

		foreach ( $this->all() as $color ) {

			$value = $color->rgb();

			$css .= sprintf(
				'--color-%s: %s;',
				esc_html( $color->name() ),
				esc_html( "{$value['r']},{$value['g']},{$value['b']}" )
			);
		}

		return ":root { {$css} }";
	}
}
