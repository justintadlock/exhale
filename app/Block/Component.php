<?php

namespace Exhale\Block;

use Hybrid\Contracts\Bootable;

class Component implements Bootable {

	public function boot() {

		if ( ! is_admin() ) {
			add_filter( 'the_content', [ $this, 'renderBlock' ], PHP_INT_MAX );
		}
	}

	public function renderBlock( $content  ) {

		// If there's no content or if the content doesn't contain HTML,
		// bail early.
		if ( ! trim( $content ) || false === strpos( $content, '<' ) ) {
			return $content;
		}

		$doc = new \DOMDocument();
		libxml_use_internal_errors( true );
		$doc->loadHTML(
			sprintf(
				'<!DOCTYPE html><html><head><meta charset="%s"></head><body>%s</body></html>',
				esc_attr( get_bloginfo( 'charset' ) ),
				$content
			)
		);
		libxml_clear_errors();

		// Get the body element.
		$body = $doc->getElementsByTagName( 'body' )->item( 0 );

		// Remove the body element.
		$body = $body->parentNode->removeChild( $body );

		// Remove all elements from the doc.
		while ( $doc->firstChild ) {
		    $doc->removeChild( $doc->firstChild );
		}

		// Re-add all children of the body element.
		while ( $body->firstChild ) {
		    $doc->appendChild( $body->firstChild );
		}

		// Now, let's get all elements.
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

			if ( $trueTextAlign = $this->trueTextAlign( $class ) ) {
				$new_classes[] = $trueTextAlign;
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

	private function trueTextAlign( $class ) {

		$aligns = [
			'has-text-align-left'   => 'text-left',
			'has-text-align-center' => 'text-center',
			'has-text-align-right'  => 'text-right'
		];

		foreach ( $aligns as $align => $new_align ) {
			if ( false !== strpos( $class, $align ) ) {
				return $new_align;
			}
		}

		return false;
	}



}
