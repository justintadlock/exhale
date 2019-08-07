<?php

namespace Exhale\Block;

use Hybrid\Contracts\Bootable;

class Component implements Bootable {

	public function boot() {

		if ( ! is_admin() ) {
			add_filter( 'the_content', [ $this, 'renderBlock' ], ~PHP_INT_MAX );
		}
	}

	public function renderBlock( $content  ) {

	//	var_dump( $block );

		$doc = new \DOMDocument();
		libxml_use_internal_errors( true );
		$doc->loadHTML(
			mb_convert_encoding( $content, 'HTML-ENTITIES', get_bloginfo( 'charset' ) ),
			LIBXML_HTML_NOIMPLIED|LIBXML_HTML_NODEFDTD
		);
		libxml_clear_errors();

		$elements = $doc->getElementsByTagName( '*' );

		foreach ( $elements as $element ) {

			$class = $element->getAttribute( 'class' );

			if ( ! $class ) {
				continue;
			}

			$new_classes = [];

			if ( $trueColor = $this->trueColor( $class ) ) {
				$new_classes[] = $trueColor;
			}

			if ( $trueBackgroundColor = $this->trueBackgroundColor( $class ) ) {
				$new_classes[] = $trueBackgroundColor;
			}

			if ( $trueFontSize = $this->trueFontSize( $class ) ) {
				$new_classes[] = $trueFontSize;
			}

			if ( $new_classes ) {
				$element->setAttribute( 'class', sprintf(
					'%s %s',
					$class,
					join( ' ', $new_classes )
				) );
			}
		}

		$content = $doc->saveHTML();

		return $content;
	}

	private function trueFontSize( $class ) {

		$sizes = [
			'fine'        => '3xs',
			'diminutive'  => '2xs',
			'tiny'        => 'xs',
			'small'       => 'sm',
			'medium'      => 'base',
			'large'       => 'lg',
			'extra-large' => 'xl',
			'huge'        => '2xl',
			'gargantuan'  => '3xl',
			'colossal'    => '4xl',
			'titanic'     => '5xl'
		];

		foreach ( $sizes as $size => $new_size ) {
			if ( false !== strpos( $class, "has-{$size}-font-size" ) ) {
				return "text-{$new_size}";
			}
		}

		return false;
	}

	private function colors() {

		$colors = [
			'white' => 'white',
			'black' => 'black'
		];

		$medium = [
			'gray',
			'red',
			'orange',
			'yellow',
			'green',
			'teal',
			'blue',
			'indigo',
			'purple',
			'pink'
		];

		$pattern = [
			'lightest' => '100',
			'lighter'  => '300',
			'light'    => '400',
			'darkest'  => '900',
			'darker'   => '700',
			'dark'     => '600'
		];

		foreach ( $medium as $medium ) {

			foreach ( $pattern as $shade => $num ) {
				$colors[ "{$medium}-{$shade}" ] = "{$medium}-{$num}";
			}
		}

		return $colors;
	}

	private function trueColor( $class ) {

		$colors = $this->colors();

		foreach ( $this->colors() as $color => $new_color ) {
			if ( false !== strpos( $class, "has-{$color}-color" ) ) {
				return "text-{$new_color}";
			}
		}

		return false;
	}

	private function trueBackgroundColor( $class ) {

		$colors = $this->colors();

		foreach ( $this->colors() as $color => $new_color ) {
			if ( false !== strpos( $class, "has-{$color}-background-color" ) ) {
				return "bg-{$new_color}";
			}
		}

		return false;
	}





}
