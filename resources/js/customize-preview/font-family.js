/**
 * Fonts live preview.
 *
 * This file handles the JavaScript for the live preview of the theme fonts
 * feature in the customizer.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

let WebFont     = require( 'webfontloader' );
let settings    = exhaleCustomizePreview.fontFamilySettings;
let choices     = exhaleCustomizePreview.fontFamilyChoices;
let loadedFonts = [];

Object.keys( settings ).forEach( setting => {

	// If the Google Font is already loaded, add it to the loaded fonts array.
	if ( choices[ settings[ setting ].mod ].googleName ) {
		loadedFonts.push( settings[ setting ].mod );
	}

	wp.customize( settings[ setting ].modName, value => {
		value.bind( to => {

			// If this is a Google font, let's use the Web Font
			// Loader to load it up.
			if ( -1 === loadedFonts.indexOf( to ) && choices[ to ].googleName ) {
				WebFont.load( {
					google : {
						families : [
							choices[ to ].googleName
						]
					}
				} );

				// Add to loaded fonts array.
				loadedFonts.push( to );
			}

			// Update the custom CSS property.
			document.documentElement.style.setProperty(
				settings[ setting ].property,
				choices[ to ].stack
			);
		} );
	} );

} );
