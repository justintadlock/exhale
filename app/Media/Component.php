<?php

namespace Exhale\Media;

use Hybrid\Contracts\Bootable;

class Component implements Bootable {

	protected $image_sizes;

	public function __construct( ImageSizes $image_sizes ) {

		$this->image_sizes = $image_sizes;
	}

	public function boot() {

		add_action( 'init', [ $this, 'init' ], 5 );

		add_filter( 'image_size_names_choose', [ $this, 'imageSizeNamesChoose'] );

		add_action( 'extant/media/register/image/sizes', [ $this, 'registerDefaultImageSizes'] );
	}

	public function init() {

		do_action( 'extant/media/register/image/sizes', $this->image_sizes );

		foreach ( $this->image_sizes->all() as $size ) {

			if ( 'post-thumbnail' === $size->name() ) {
				set_post_thumbnail_size( $size->width(), $size->height(), $size->crop() );
			} else {
				add_image_size( $size->name(), $size->width(), $size->height(), $size->crop() );
			}
		}
	}

	public function imageSizeNamesChoose( $sizes ) {

		$new_sizes = [];

		foreach ( $this->image_sizes->all() as $size ) {
			$new_sizes[ $size->name() ] = esc_html( $size->label() );
		}

		return array_merge( $sizes, $new_sizes );
	}

	public function registerDefaultImageSizes( $sizes ) {

		$sizes->add( 'post-thumbnail', [
			'label'  => __( 'Theme: Thumbnail' ),
			'width'  => 178,
			'height' => 100
		] );

		$sizes->add( 'exhale-medium', [
			'label'  => __( 'Theme: Medium' ),
			'width'  => 650,
			'height' => 366
		] );

		$sizes->add( 'exhale-wide', [
			'label'  => __( 'Theme: Wide' ),
			'width'  => 900,
			'height' => 506
		] );

		$sizes->add( 'exhale-wider', [
			'label'  => __( 'Theme: Wider' ),
			'width'  => 1366,
			'height' => 768
		] );

		$sizes->add( 'exhale-widest', [
			'label'  => __( 'Theme: Widest' ),
			'width'  => 1920,
			'height' => 1080
		] );
	}
}
