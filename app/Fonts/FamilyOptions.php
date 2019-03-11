<?php

namespace Exhale\Fonts;

use Hybrid\Tools\Collection;

class FamilyOptions extends Collection {

	public function add( $name, $value ) {

		parent::add( $name, new FamilyOption( $name, $value ) );
	}
}
