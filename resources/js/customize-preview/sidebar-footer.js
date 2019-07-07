/**
 * Custom header preview.
 *
 * This file handles the JavaScript for the live preview of the `custom-header`
 * feature in the customizer.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

let sidebarFooter = document.querySelector( '.sidebar--footer' );

let widths = [
	'alignfull',
	'alignwide'
];

let columns = [
	'columns-1',
	'columns-2',
	'columns-3',
	'columns-4'
];

wp.customize( 'sidebar_footer_align', value => {
	value.bind( to => {

		// Remove all layout classes.
		sidebarFooter.classList.remove( ...widths );

		// Add new layout class.
		if ( to ) {
			sidebarFooter.classList.add( to );
		}
	} );
} );

wp.customize( 'sidebar_footer_columns', value => {
	value.bind( to => {

		// Remove all layout classes.
		sidebarFooter.classList.remove( ...columns );

		// Add new layout class.
		sidebarFooter.classList.add( 'columns-' + to );
	} );
} );
