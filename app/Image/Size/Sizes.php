<?php

namespace Exhale\Image\Size;

use Hybrid\Tools\Collection;

class Sizes extends Collection {

	public function add( $name, $value ) {

		parent::add( $name, new Size( $name, $value ) );
	}
}
