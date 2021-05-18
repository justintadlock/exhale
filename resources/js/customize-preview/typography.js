/**
 * Typography live preview.
 *
 * This file handles the JavaScript for the live preview of the theme typography
 * feature in the customizer.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

let WebFont     = require( 'webfontloader' );
let settings    = exhaleCustomizePreview.typographySettings;
let families    = exhaleCustomizePreview.fontFamilies;
//let styles      = exhaleCustomizePreview.fontStyles;
//let caps        = exhaleCustomizePreview.fontVariantCaps;
//let transforms  = exhaleCustomizePreview.textTransforms;
let loadedFonts = [];

Object.keys( settings ).forEach( key => {

	let setting = settings[ key ];

	// If the Google Font is already loaded, add it to the loaded fonts array.
	if ( families[ setting.mods.family ].googleName ) {
		loadedFonts.push( setting.mods.family );
	}

	wp.customize( setting.modNames.family, value => {

		value.bind( to => {

			let family = families[ to ];

			// If this is a Google font, let's use the Web Font
			// Loader to load it up.
			if ( -1 === loadedFonts.indexOf( family.name ) && family.googleName ) {
				WebFont.load( {
					google : {
						families : [
							family.googleName + ':' + family.styles.join( ',' )
						]
					}
				} );

				// Add to loaded fonts array.
				loadedFonts.push( family.name );
			}

			// Update the custom CSS property.
			document.documentElement.style.setProperty(
				'--font-family-' + setting.name,
				family.stack
			);
		} );
	} );
} );
