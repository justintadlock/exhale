<?php

namespace Exhale\Colors;

use Hybrid\Contracts\Bootable;

class Manager implements Bootable {

	protected $colors;

	public function __construct( Colors $colors ) {

		$this->colors = $colors;
	}

	public function boot() {

		add_action( 'after_setup_theme', [ $this, 'addThemeSupport' ] );

		add_action( 'extant/colors/register', [ $this, 'registerDefaultColors'] );
	}

	public function addThemeSupport() {

		do_action( 'extant/colors/register', $this->colors );

		$palette = [];

		foreach ( $this->colors->all() as $color ) {
			$palette[] = [
				'name'  => $color->label(),
				'slug'  => $color->name(),
				'color' => $color->color()
			];
		}

		// Editor color palette.
		add_theme_support( 'editor-color-palette', $palette );
	}

	public function registerDefaultColors( $colors ) {

		$_colors = [
			'black'      => [
				'color' => '#000000',
				'label' => __( 'Black' )
			],
			'mine-shaft' => [
				'color' => '#222222',
				'label' => __( 'Mine Shaft' )
			],
			'charcoal' => [
				'color' => '#454545',
				'label' => __( 'Charcoal' )
			],
			'bayou' => [
				'color' => '#687d81',
				'label' => __( 'Bayou' )
			],
			'dusty-gray' => [
				'color' => '#959595',
				'label' => __( 'Dusty Gray' )
			],
			'mercury' => [
				'color' => '#e1e1e1',
				'label' => __( 'Mercury' )
			],
			'eastern-blue' => [
				'color' => '#207bb2',
				'label' => __( 'Eastern Blue' )
			],
			'malachite' => [
				'color' => '#06b236',
				'label' => __( 'Malachite' )
			],
			'persimmon' => [
				'color' => '#ff5456',
				'label' => __( 'Persimmon' )
			],
			'coral-red' => [
				'color' => '#ff3b3d',
				'label' => __( 'Coral Red' )
			],
			'silver-chalice' => [
				'color' => '#a9a9a9',
				'label' => __( 'Silver Chalice' )
			],
			'white-smoke' => [
				'color' => '#f1f1f1',
				'label' => __( 'White Smoke' ),
			],
			'wild-sand' => [
				'color' => '#f6f6f6',
				'label' => __( 'Wild Sand' )
			],
			'white' => [
				'color' => '#ffffff',
				'label' => __( 'White' )
			]
		];

		foreach ( $_colors as $name => $options ) {
			$colors->add( $name, $options );
		}
	}
}
