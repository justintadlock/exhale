<?php

namespace Exhale\Colors;

use Hybrid\Tools\Collection;

use function Hybrid\hex_to_rgb;

class Colors extends Collection {

	public function add( $name, $value ) {

		parent::add( $name, new Color( $name, $value ) );
	}

	public function inlineStyle() {

		$css = '';

		foreach ( $this->all() as $color ) {

			$value = hex_to_rgb( $color->color() );

			$css .= sprintf( '--color-%s: %s;', $color->name(), "{$value['r']},{$value['g']},{$value['b']}" );
		}

		return ":root { {$css} }";
	}
}
