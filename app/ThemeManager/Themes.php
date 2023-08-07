<?php
/**
 * Themes Collection.
 *
 * Houses the collection of themes in a single array-object.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\ThemeManager;

use Exhale\Tools\Collection;

/**
 * Themes class.
 *
 * @since  1.2.0
 *
 * @access public
 */
class Themes extends Collection {

    /**
     * Adds a new theme to the collection.
     *
     * @since  1.2.0
     * @param  string $name
     * @param  array  $value
     * @return void
     *
     * @access public
     */
    public function add( $name, $value ) {
        parent::add( $name, new Theme( $name, $value ) );
    }

}
