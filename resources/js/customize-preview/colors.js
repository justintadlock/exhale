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

let hexToRgb = str => {

	let pattern = /^#?(?:([\da-f]{3})[\da-f]?|([\da-f]{6})(?:[\da-f]{2})?)$/i;

	let [ , short, long ] = String( str ).match( pattern ) || [];

	if ( long ) {
		let value = Number.parseInt( long, 16 );

		return [
			value >> 16,
			value >> 8 & 0xFF,
			value & 0xFF
		];

	} else if ( short ) {

		return Array.from(
			short,
			s => Number.parseInt( s, 16 )
		).map( n => ( n << 4 ) | n );
	}
};

exhaleColorDefinitions.forEach( color => {

	wp.customize( color.modName, value => {
		value.bind( to => {
			document.documentElement.style.setProperty( color.property, hexToRgb( to ) );
		} );
	} );

} );
