<?php

namespace Exhale\Fonts;

use Hybrid\Tools\Collection;

class Families extends Collection {

	public function add( $name, $value ) {

		parent::add( $name, new Family( $name, $value ) );
	}
}
