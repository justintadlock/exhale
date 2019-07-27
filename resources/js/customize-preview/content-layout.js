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

// Global set via `wp_localize_script()`.
const { loopQueries } = exhaleCustomizePreview;

let widths = [
	'max-w-2xl',
	'max-w-3xl',
	'max-w-4xl',
	'max-w-5xl',
	'max-w-full'
];

let columns = [
	'grid-col-1',
	'grid-col-2',
	'grid-col-3',
	'grid-col-4',
	'grid-col-5',
	'grid-col-6'
];

let mdColumns = [
	'md\:grid-col-1',
	'md\:grid-col-2',
	'md\:grid-col-3',
	'md\:grid-col-4',
	'md\:grid-col-5',
	'md\:grid-col-6'
];

Object.values( loopQueries ).forEach( ( type ) => {

	let loopClass = '.loop--' + type.replace( /_/g, '-' );

	wp.customize( `loop_${type}_width`, value => {
		value.bind( to => {

			let container = document.querySelector( `${loopClass} .grid--posts` );

			if ( ! container ) {
				return;
			}

			// Remove all layout classes.
			container.classList.remove( ...widths );

			// Add new layout class.
			if ( to ) {
				container.classList.add( 'max-w-' + to );
			}
		} );
	} );

	wp.customize( `loop_${type}_columns`, value => {
		value.bind( to => {

			let container = document.querySelector( `${loopClass} .grid--posts` );

			if ( ! container ) {
				return;
			}

			// Remove all layout classes.
			container.classList.remove( ...mdColumns );

			// Add new layout class.
			container.classList.add( 'md\:grid-col-' + to );
		} );
	} );

	wp.customize( `loop_${type}_image_size`, value => {
		value.bind( to => {

			let container = document.querySelector( `${loopClass} .grid--posts` );

			if ( ! container ) {
				return;
			}

			container.classList.remove( ...columns );

			if ( to.includes( 'landscape' ) ) {
				container.classList.add( 'grid-col-1' );
			} else {
				container.classList.add( 'grid-col-2' );
			}

		} );
	} );

} );
