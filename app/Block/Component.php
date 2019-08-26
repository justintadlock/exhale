<?php
/**
 * Block component.
 *
 * Handles the block feature.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Block;

use Hybrid\Contracts\Bootable;

/**
 * Block component class.
 *
 * @since  2.2.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Bootstraps the class' actions/filters.
	 *
	 * @since  2.2.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		if ( ! is_admin() ) {
			add_filter( 'the_content', [ $this, 'filterBlockClasses' ], PHP_INT_MAX );
		}
	}

	/**
	 * Filters block classes to match our CSS classes.
	 *
	 * @since  2.2.0
	 * @access public
	 * @param  string  $content
	 * @return string
	 */
	public function filterBlockClasses( $content ) {

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

		// Loop through the elements and update the classes if necessary.
		foreach ( $elements as $element ) {

			$class = $element->getAttribute( 'class' );

			// Skip if the element doesn't have a class.
			if ( ! $class ) {
				continue;
			}

			$new_classes = [];

			$methods = [
				'trueFontSize',
				'trueTextAlign',
				'trueColor',
				'trueBackgroundColor'
			];

			foreach ( $methods as $method ) {

				if ( $add_class = $this->$method( $class ) ) {
					$new_classes[] = $add_class;
				}
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

	/**
	 * Checks if an HTML class contains one of our given font size classes
	 * and returns a mapped class name to use instead.
	 *
	 * @since  2.2.0
	 * @access public
	 * @param  string       $class
	 * @return string|bool
	 */
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

	/**
	 * Checks if an HTML class contains one of our given text align classes
	 * and returns a mapped class name to use instead.
	 *
	 * @since  2.2.0
	 * @access public
	 * @param  string       $class
	 * @return string|bool
	 */
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

	/**
	 * Checks if an HTML class contains one of our given text color classes
	 * and returns a mapped class name to use instead.
	 *
	 * @since  2.2.0
	 * @access public
	 * @param  string       $class
	 * @return string|bool
	 */
	private function trueColor( $class ) {

		$colors = $this->colors();

		foreach ( $this->colors() as $color => $new_color ) {
			if ( false !== strpos( $class, "has-{$color}-color" ) ) {
				return "text-{$new_color}";
			}
		}

		return false;
	}

	/**
	 * Checks if an HTML class contains one of our given background color classes
	 * and returns a mapped class name to use instead.
	 *
	 * @since  2.2.0
	 * @access public
	 * @param  string       $class
	 * @return string|bool
	 */
	private function trueBackgroundColor( $class ) {

		$colors = $this->colors();

		foreach ( $this->colors() as $color => $new_color ) {
			if ( false !== strpos( $class, "has-{$color}-background-color" ) ) {
				return "bg-{$new_color}";
			}
		}

		return false;
	}

	/**
	 * Returns an array of mapped color classes.
	 *
	 * @since  2.2.0
	 * @access public
	 * @return array
	 */
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
			$colors[ $medium ] = "{$medium}-500";

			foreach ( $pattern as $shade => $num ) {
				$colors[ "{$medium}-{$shade}" ] = "{$medium}-{$num}";
			}
		}

		return $colors;
	}
}
