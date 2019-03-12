<?php

namespace Exhale\Image\Size;

use Hybrid\Contracts\Bootable;
use Exhale\Tools\Config;

class Component implements Bootable {

	protected $sizes;

	public function __construct( Sizes $sizes ) {

		$this->sizes = $sizes;
	}

	public function boot() {

		add_action( 'init', [ $this, 'register' ], 5 );

		add_filter( 'image_size_names_choose', [ $this, 'imageSizeNamesChoose'] );

		add_action( 'extant/image/size/register', [ $this, 'registerDefaultImageSizes'] );
	}

	public function register() {

		do_action( 'extant/image/size/register', $this->sizes );

		foreach ( $this->sizes->all() as $size ) {

			if ( 'post-thumbnail' === $size->name() ) {
				set_post_thumbnail_size( $size->width(), $size->height(), $size->crop() );
			} else {
				add_image_size( $size->name(), $size->width(), $size->height(), $size->crop() );
			}
		}
	}

	public function imageSizeNamesChoose( $sizes ) {

		$new_sizes = [];

		foreach ( $this->sizes->all() as $size ) {
			$new_sizes[ $size->name() ] = esc_html( $size->label() );
		}

		return array_merge( $sizes, $new_sizes );
	}

	public function registerDefaultImageSizes( $sizes ) {

		foreach ( Config::get( 'image-sizes.php' ) as $name => $options ) {
			$sizes->add( $name, $options );
		}
	}
}
