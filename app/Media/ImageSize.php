<?php

namespace Exhale\Media;

class ImageSize {

	protected $name;

	protected $label;

	protected $width = 150;
	protected $height = 150;
	protected $crop = true;

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
		return $this->label ?: $this->name();
	}

	public function width() {
		return $this->width;
	}

	public function height() {
		return $this->height;
	}

	public function crop() {
		return $this->crop;
	}
}
