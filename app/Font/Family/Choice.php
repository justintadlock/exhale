<?php

namespace Exhale\Font\Family;

class Choice {

	protected $name;

	protected $label;

	protected $stack = 'system-ui';

	public function __construct( $name, array $options ) {

		foreach ( array_keys( get_object_vars( $this ) ) as $key ) {
			if ( isset( $options[ $key ] ) ) {
				$this->$key = $options[ $key ];
			}
		}

		$this->name = $name;
	}

	public function name() {
		return $this->name;
	}

	public function label() {

		return apply_filters(
			"exhale/font/family/{$this->name}/label",
			$this->label ?: $this->name()
		);
	}

	public function stack() {

		return apply_filters(
			"exhale/font/family/{$this->name}/stack",
			$this->stack
		);
	}
}
