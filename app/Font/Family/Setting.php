<?php

namespace Exhale\Font\Family;

use JsonSerializable;

class Setting implements JsonSerializable {

	protected $name;

	protected $label;

	protected $description = '';

	protected $default = 'system-ui';

	public function __construct( $name, array $options ) {

		foreach ( array_keys( get_object_vars( $this ) ) as $key ) {
			if ( isset( $options[ $key ] ) ) {
				$this->$key = $options[ $key ];
			}
		}

		$this->name = $name;
	}

	public function jsonSerialize() {
		return [
			'modName' => $this->modName(),
			'property' => $this->property()
		];
	}

	public function name() {
		return $this->name;
	}

	public function label() {
		return $this->label ?: $this->name();
	}

	public function description() {
		return $this->description;
	}

	public function modName() {
		return str_replace( '-', '_', $this->name() );
	}

	public function mod() {
		return get_theme_mod( $this->modName(), $this->default() );
	}

	public function default() {
		return $this->default;
	}

	public function property() {
		return sprintf( '--font-family-%s', $this->name() );
	}
}
