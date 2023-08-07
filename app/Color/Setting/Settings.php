<?php
/**
 * Color Settings Collection.
 *
 * Houses the collection of customize colors in a single array-object.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Color\Setting;

use Exhale\Tools\Collection;

/**
 * Customize color settings class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class Settings extends Collection {

    /**
     * Adds a new customize color to the collection.
     *
     * @since  1.0.0
     * @param  string $name
     * @param  array  $value
     * @return void
     *
     * @access public
     */
    public function add( $name, $value ) {
        parent::add( $name, new Setting( $name, $value ) );
    }

}
