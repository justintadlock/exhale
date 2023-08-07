<?php
/**
 * Editor Colors Collection.
 *
 * Houses the collection of editor colors in a single array-object.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Editor\Color;

use Exhale\Tools\Collection;

/**
 * Editor colors class.
 *
 * @since  2.0.0
 *
 * @access public
 */
class Colors extends Collection {

    /**
     * Adds a new color color to the collection.
     *
     * @since  2.0.0
     * @param  string $name
     * @param  array  $value
     * @return void
     *
     * @access public
     */
    public function add( $name, $value ) {
        parent::add( $name, new Color( $name, $value ) );
    }

    /**
     * Returns an array of colors ready for the editor color palette
     * `add_theme_support()` call.
     *
     * @since  2.0.0
     * @return array
     *
     * @access public
     */
    public function palette() {

        $palette = [];

        foreach ( $this->sort( $this->all() ) as $color ) {
            $palette[] = [
                'color' => $color->hex(),
                'name'  => $color->label(),
                'slug'  => $color->name(),
            ];
        }

        return $palette;
    }

    /**
     * Sorts the colors from darkest to lightest.
     *
     * @since  2.0.0
     * @param  array $colors
     * @return array
     *
     * @access public
     */
    public function sort( array $colors = [] ) {

        $colors = $colors ?: $this->all();

        usort( $colors, static function( $a, $b ) {
            $_a = $a->rgb();
            $_b = $b->rgb();

            if ( ( $_a['r'] + $_a['g'] + $_a['b'] ) > ( $_b['r'] + $_b['g'] + $_b['b'] ) ) {
                return 1;
            }

            return -1;
        } );

        return $colors;
    }

}
