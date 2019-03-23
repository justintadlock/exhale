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

let settings = exhaleCustomizePreview.colorSettings;

Object.keys( settings ).forEach( setting => {

	wp.customize( settings[ setting ].modName, value => {
		value.bind( to => {
			document.documentElement.style.setProperty(
				settings[ setting ].property,
				to
			);
		} );
	} );

} );
