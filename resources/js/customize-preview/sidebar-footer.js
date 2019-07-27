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

let smColumns = [
	'sm\:grid-col-1',
	'sm\:grid-col-2',
	'sm\:grid-col-3',
	'sm\:grid-col-4',
	'sm\:grid-col-5',
	'sm\:grid-col-6'
];

let mdColumns = [
	'md\:columns-1',
	'md\:columns-2',
	'md\:columns-3',
	'md\:columns-4'
];

if ( 'undefined' !== typeof wp.customize.selectiveRefresh ) {

	wp.customize.selectiveRefresh.bind( 'sidebar-update', ( sidebarPartial ) => {

		if ( sidebars.includes( sidebarPartial.sidebarId ) ) {

			if ( ! sidebarFooter ) {
				return;
			}

			let count = sidebarFooter.childElementCount;

			sidebarFooter.classList.remove( ...smColumns );
			sidebarFooter.classList.remove( ...mdColumns );

			sidebarFooter.classList.add( 'sm\:grid-col-' + 2 <= count ? 2 : 1 );

			sidebarFooter.classList.add( `md\:grid-col-${ count }` );
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
