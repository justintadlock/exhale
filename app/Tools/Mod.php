<?php

namespace Exhale\Tools;

use Hybrid\App;
use Exhale\Color\CustomizeColors;

use function Hybrid\Theme\mod;

class Mod {

	public function get( $name, $default = '' ) {
		return mod( $name, $default );
	}

	public static function color( $name, $default = '' ) {
		$colors = App::resolve( CustomizeColors::class );

		return $colors->has( $name ) ? $colors->get( $name )->mod() : $default;
	}
}
