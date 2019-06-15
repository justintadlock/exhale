<?php
/**
 * CSS Custom Property.
 *
 * Interface for defining an object to be used as a CSS custom property.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Tools;

use Exhale\Contracts\CssCustomProperty;

/**
 * CSS custom property interface.
 *
 * @since  1.3.0
 * @access public
 */
class CustomProperty implements CssCustomProperty {

	protected $selector = '';
	protected $property = '';
	protected $value = '';

	public function __construct( $selector, $property, $value ) {
		$this->selector = $selector;
		$this->property = $property;
		$this->value    = $value;
	}

	/**
	 * Returns a valid CSS selector for the property.
	 *
	 * @since  1.3.0
	 * @access public
	 * @return string
	 */
	public function cssSelector() {
		return $this->selector;
	}

	/**
	 * Returns the CSS property.
	 *
	 * @since  1.3.0
	 * @access public
	 * @return string
	 */
	public function cssProperty() {
		return $this->property;
	}

	/**
	 * Returns the CSS property value.
	 *
	 * @since  1.3.0
	 * @access public
	 * @return string
	 */
	public function cssValue() {
		return $this->value;
	}
}
