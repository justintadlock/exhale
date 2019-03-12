<?php

namespace Exhale\Font\Family;

use JsonSerializable;
use Hybrid\Tools\Collection;

class Settings extends Collection implements JsonSerializable {

	public function add( $name, $value ) {

		parent::add( $name, new Setting( $name, $value ) );
	}

	public function jsonSerialize() {

		return array_map( function( $value ) {

			if ( $value instanceof JsonSerializable ) {
				return $value->jsonSerialize();
			}

			return $value;

		}, $this->all() );
	}

	public function customizeToJson() {

		$json = [];

		foreach ( $this->all() as $setting ) {
			$json[] = [
				'modName' => $setting->modName(),
				'property' => sprintf( '--font-family-%s', $setting->name() )
			];
		}

		return $json;
	}
}
