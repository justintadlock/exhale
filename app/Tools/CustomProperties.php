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
 * @copyright 2019 Justin Tadlock
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

		$css = '';

		foreach ( $this->all() as $property => $value ) {
			$css .= sprintf(
				'%s: %s;',
				esc_html( $property ),
				wp_strip_all_tags( $value )
			);
		}

		return sprintf( ':root { %s }', $css );
	}
}
