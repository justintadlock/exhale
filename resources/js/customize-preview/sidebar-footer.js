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

let sidebarFooter = document.querySelector( '.grid--sidebar-footer' );

let sidebars = [
	'footer-1',
	'footer-2',
	'footer-3',
	'footer-4'
];

let widths = [
	'max-w-2xl',
	'max-w-3xl',
	'max-w-4xl',
	'max-w-5xl',
	'max-w-full'
];

let columns = [
	'columns-1',
	'columns-2',
	'columns-3',
	'columns-4'
];

if ( 'undefined' !== typeof wp.customize.selectiveRefresh ) {

	wp.customize.selectiveRefresh.bind( 'sidebar-update', ( sidebarPartial ) => {

		if ( sidebars.includes( sidebarPartial.sidebarId ) ) {

			if ( ! sidebarFooter ) {
				return;
			}

			sidebarFooter.classList.remove( ...columns );

			sidebarFooter.classList.add( 'columns-' + sidebarFooter.childElementCount );
		}
	} );
}

wp.customize( 'sidebar_footer_width', value => {
	value.bind( to => {

		if ( ! sidebarFooter ) {
			return;
		}

		// Remove all layout classes.
		sidebarFooter.classList.remove( ...widths );

		// Add new layout class.
		if ( to ) {
			sidebarFooter.classList.add( 'max-w-' + to );
		}
	} );
} );
