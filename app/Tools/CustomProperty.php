<?php
/**
 * CSS Custom Property.
 *
 * Interface for defining an object to be used as a CSS custom property.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Tools;

use Closure;
use Exhale\Contracts\CssCustomProperty;

/**
 * CSS custom property interface.
 *
 * @since  2.0.0
 *
 * @access public
 */
class CustomProperty implements CssCustomProperty {

    public function __construct( protected $selector = '', protected $property = '', protected $value = '' ) {
    }

    /**
     * Returns a valid CSS selector for the property.
     *
     * @since  2.0.0
     * @return string
     *
     * @access public
     */
    public function cssSelector() {
        return $this->selector;
    }

    /**
     * Returns the CSS property.
     *
     * @since  2.0.0
     * @return string
     *
     * @access public
     */
    public function cssProperty() {
        return $this->property;
    }

    /**
     * Returns the CSS property value.
     *
     * @since  2.0.0
     * @return string
     *
     * @access public
     */
    public function cssValue() {

        return $this->value instanceof Closure
                ? $this->value()
                : $this->value;
    }

}
