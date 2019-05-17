/**
 * Layouts preview.
 *
 * This file handles the JavaScript for the live preview of the layouts feature
 * in the customizer.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

// Gets an array of all layout class names.
let layouts = Object.values( exhaleCustomizePreview.layouts ).map( layout =>
	'layout-' + layout.name
);

wp.customize( 'layout', value => {
	value.bind( to => {
		let body = document.querySelector( 'body' );

		// Remove all layout classes.
		body.classList.remove( ...layouts );

		// Add new layout class.
		body.classList.add( 'layout-' + to );
	} );
} );
