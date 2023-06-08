<?php
/**
 * CSS Custom Properties Collection.
 *
 * This class allows an easy method for the theme to append custom properties
 * from various components to a single collection. Then, we can turn around and
 * output them all at once without having to micro-manage each component's
 * custom properties separately, making sure they're attached to the appropriate
 * style on the front/back end.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Tools;

/**
 * Custom properties class.
 *
 * @since  1.0.0
 * @access public
 */
class CustomProperties extends Collection {

	/**
	 * Returns the CSS for the collection of properties.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function css() {

		$css       = '';
		$selectors = [];
		$all       = [];

		foreach ( $this->all() as $property ) {

			if ( method_exists( $property, 'cssCustomProperties' ) ) {
				foreach ( $property->cssCustomProperties() as $property ) {
					$all[] = $property;
				}
			} else {
				$all[] = $property;
			}
		}

		// Loop through all the properties and sort them by selector.
		foreach ( $all as $property ) {

			if ( ! isset( $selectors[ $property->cssSelector() ] ) ) {
				$selectors[ $property->cssSelector() ] = [];
			}

			$selectors[ $property->cssSelector() ][] = $property;
		}

		// Loop through each of the selectors and add their CSS.
		foreach ( $selectors as $selector => $properties ) {

			$selector_css = '';

			foreach ( $properties as $property ) {
				$selector_css .= sprintf(
					'%s: %s;',
					esc_html( $property->cssProperty() ),
					wp_strip_all_tags( $property->cssValue() )
				);
			}

			$css .= sprintf( '%s { %s }', esc_html( $selector ), $selector_css );
		}

		return $css;
	}
}
