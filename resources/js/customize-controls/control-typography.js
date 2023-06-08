/**
 * Font Customize Control.
 *
 * This file handles the JavaScript for the font customize control.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

wp.customize.controlConstructor['exhale-typography'] = wp.customize.Control.extend( {

	ready: function() {

		// Globals set via `wp_localize_script()`.
		let families = exhaleCustomizeControls.fontFamilies;
		let styles   = exhaleCustomizeControls.fontStyles;

		let control       = this;
		let familySetting = control.settings.family;
		let styleSetting  = control.settings.style;

		// Bail if there is no family or style setting for this control.
		if ( ! familySetting || ! styleSetting ) {
			return;
		}

		// When a new font family is chosen, we need to get the family
		// object and update the font style list with the allowed styles
		// for the family.
		familySetting.bind( value => {

			let family = families[ value ];

			let select = document.querySelector(
				control.selector + ' [data-customize-setting-link=' + styleSetting.id + ']'
			);

			// Remove all options from the select. We're going to
			// rebuild it below.
			for ( let i = select.options.length; 0 <= i ; i-- ) {
				select.remove( i );
			}

			// Set the selected option. If the current option is
			// supported by the family, use it. Otherwise, use the
			// first available style.

			let selectedOption = family.styles[0];

			if ( -1 !== family.styles.indexOf( styleSetting.get() ) ) {
				selectedOption = styleSetting.get();
			}

			styleSetting.set( selectedOption );

			// Loop through the family's supported styles and add
			// them to the dropdown.
			family.styles.forEach( styleName => {

				let opt       = document.createElement( 'option' );
				opt.value     = styleName;
				opt.innerHTML = styles[ styleName ].label;

				if ( styleName === selectedOption ) {
					opt.setAttribute( 'selected', 'selected' );
				}

				select.appendChild( opt );

			} );
		} );
	}
} );
