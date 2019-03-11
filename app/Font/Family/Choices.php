<?php

namespace Exhale\Font\Family;

use Hybrid\Tools\Collection;

class Choices extends Collection {

	public function add( $name, $value ) {

		parent::add( $name, new Choice( $name, $value ) );
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
