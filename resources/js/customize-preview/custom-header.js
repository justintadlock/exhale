/**
 * Custom header preview.
 *
 * This file handles the JavaScript for the live preview of the `custom-header`
 * feature in the customizer.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

// Site title.
wp.customize( 'blogname', value => {
	value.bind( to => {
		document.querySelector( '.app-header__title-link' ).textContent = to;
	} );
} );

// Site description.
wp.customize( 'blogdescription', value => {
	value.bind( to => {
		document.querySelector( '.app-header__description' ).textContent = to;
	} );
} );
