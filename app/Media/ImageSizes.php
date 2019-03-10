<?php

namespace Exhale\Media;

use Hybrid\Tools\Collection;

class ImageSizes extends Collection {

	public function add( $name, $value ) {

		parent::add( $name, new ImageSize( $name, $value ) );
	}
}
