<?php
/**
 * Template tags.
 *
 * This file holds template tags for the theme. Template tags are PHP functions
 * meant for use within theme templates.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale;

/**
 * Returns the metadata separator.
 *
 * @since  1.0.0
 * @param  string $sep  String to separate metadata.
 * @return string
 *
 * @access public
 */
function sep( $sep = '' ) {

    return apply_filters(
        'exhale/sep',
        sprintf(
            ' <span class="sep mx-2">%s</span> ',
            $sep ?: esc_html_x( '&middot;', 'meta separator', 'exhale' )
        )
    );
}
