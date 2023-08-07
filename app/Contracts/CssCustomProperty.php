<?php
/**
 * CSS Custom Property Contract.
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

namespace Exhale\Contracts;

/**
 * CSS custom property interface.
 *
 * @since  1.1.0
 *
 * @access public
 */
interface CssCustomProperty {

    /**
     * Returns a valid CSS selector for the property.
     *
     * @since  1.1.0
     * @return string
     *
     * @access public
     */
    public function cssSelector();

    /**
     * Returns the CSS property.
     *
     * @since  1.1.0
     * @return string
     *
     * @access public
     */
    public function cssProperty();

    /**
     * Returns the CSS property value.
     *
     * @since  1.1.0
     * @return string
     *
     * @access public
     */
    public function cssValue();

}
