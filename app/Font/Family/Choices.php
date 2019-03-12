<?php

namespace Exhale\Font\Family;

use JsonSerializable;
use Hybrid\Tools\Collection;

class Choices extends Collection implements JsonSerializable {

	public function add( $name, $value ) {

		parent::add( $name, new Choice( $name, $value ) );
	}

	public function jsonSerialize() {

		return array_map( function( $value ) {

			if ( $value instanceof JsonSerializable ) {
				return $value->jsonSerialize();
			}

			return $value;

		}, $this->all() );
	}

	public function customizeChoices() {

		$customize = [];

		foreach ( $this->all() as $choice ) {
			$customize[ esc_attr( $choice->name() ) ] = esc_html( $choice->label() );
		}

		return $customize;
	}

	public function customizeToJson() {

		$json = [];

		foreach ( $this->all() as $choice ) {
			$json[ $choice->name() ] = [
				'stack' => $choice->stack()
			];
		}

		return $json;
	}
}
