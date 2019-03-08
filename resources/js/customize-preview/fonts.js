/**
 * Fonts live preview.
 *
 * This file handles the JavaScript for the live preview of the theme fonts
 * feature in the customizer.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

let options = [
	'primary',
	'secondary',
	'headings'
];

options.forEach( option => {
	wp.customize( 'font_family_' + option, value => {
		value.bind( to => {
			document.documentElement.style.setProperty( '--font-family-' + option, exhaleFontDefinitions[ to ] );
		} );
	} );
} );
