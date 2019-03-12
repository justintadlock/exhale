<?php

namespace Exhale\Color;

use JsonSerializable;
use function Hybrid\hex_to_rgb;

class Setting implements JsonSerializable {

	protected $name;

	protected $label;
	protected $description = '';

	protected $default = '#000000';

	protected $is_editor_color = true;
	protected $is_customizer_color = true;

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
			'modName'  => $this->modName(),
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

	public function default() {
		return $this->default;
	}

	public function hex() {
		return maybe_hash_hex_color( $this->mod() );
	}

	public function rgb() {
		return hex_to_rgb( $this->mod() );
	}

	public function property() {
		return sprintf( '--color-%s', $this->name() );
	}

	public function isEditorColor() {
		return $this->is_editor_color;
	}

	public function isCustomizerColor() {
		return $this->is_customizer_color;
	}

	public function modName() {
		return sprintf( 'color_%s', str_replace( '-', '_', $this->name ) );
	}

	public function mod() {

		return $this->isCustomizerColor()
		       ? get_theme_mod( $this->modName(), $this->default() )
		       : $this->default();
	}
}
