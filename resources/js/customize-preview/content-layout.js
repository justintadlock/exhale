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

let types = [
	'blog',
	'archive'
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
	'columns-4',
	'columns-5',
	'columns-6'
];

let aspectRatios = [
	'landscape',
	'portrait',
	'square'
];

types.forEach( ( type ) => {

	wp.customize( `loop_${type}_width`, value => {
		value.bind( to => {

			let container = document.querySelector( `.loop--${type} .grid--posts` );

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

			let container = document.querySelector( `.loop--${type} .grid--posts` );

			if ( ! container ) {
				return;
			}

			// Remove all layout classes.
			container.classList.remove( ...columns );

			// Add new layout class.
			container.classList.add( 'columns-' + to );
		} );
	} );

	wp.customize( `loop_${type}_image_size`, value => {
		value.bind( to => {

			let container = document.querySelector( `.loop--${type} .grid--posts` );

			if ( ! container ) {
				return;
			}

			// Remove all layout classes.
			aspectRatios.forEach( ( ratio ) => {

				if ( to.includes( ratio ) && ! container.classList.contains( 'grid--' + ratio ) ) {
					container.classList.add( 'grid--' + ratio );

				} else if ( ! to.includes( ratio ) ) {
					container.classList.remove( 'grid--' + ratio );
				}
			} );

		} );
	} );

} );
