/**
 * Font Customize Control.
 *
 * This file handles the JavaScript for the font customize control.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

wp.customize.bind( 'ready', () => {

	// Global set via `wp_localize_script()`.
	const { backgroundPatterns } = exhaleCustomizeControls;

	let types = [
		'content'
	];

	const backgroundSvgUrl = ( svg, fill, opacity ) => {

		let url = svg.replace( /fill="#[a-fA-F0-9_-]*"/, 'fill="' + fill + '"' )
		             .replace( /fill-opacity="[0-9.]*"/, 'fill-opacity="' + opacity + '"' )
		             .replace( /\"/g, '\''  )
			     .replace( /\</g, '%3C' )
			     .replace( /\>/g, '%3E' )
			     .replace( /\&/g, '%26' )
			     .replace( /\#/g, '%23' );

		let css = 'url("data:image/svg+xml,' + url + '")';

		return css;
	};

	types.forEach( type => {

		let backgroundSvgControl = wp.customize.control( `${type}_background_svg` );

		wp.customize.control( `color_${type}_background`, control => {

			control.setting.bind( color => {

				let blocks  = document.querySelectorAll(
					backgroundSvgControl.selector + ' .svg-background__block'
				);

				blocks.forEach( block => {
					block.style.backgroundColor = color;
				} );

			} );
		} );

		wp.customize.control( `color_${type}_background_fill`, control => {

			control.setting.bind( color => {

				let opacity = wp.customize.control( `${type}_background_fill_opacity` ).settings.default.get();

				let blocks = document.querySelectorAll(
					backgroundSvgControl.selector + ' .svg-background__block'
				);

				blocks.forEach( block => {

					if ( block.dataset.svg ) {

						let pattern = backgroundPatterns[ block.dataset.svg ];

						block.style.backgroundImage = backgroundSvgUrl(
							pattern.svg,
							color,
							opacity
						);
					}
				} );
			} );
		} );

		wp.customize.control( `${type}_background_fill_opacity`, control => {

			control.setting.bind( opacity => {

				let color = wp.customize.control( `color_${type}_background_fill` ).settings.default.get();

				let blocks = document.querySelectorAll(
					backgroundSvgControl.selector + ' .svg-background__block'
				);

				blocks.forEach( block => {

					if ( block.dataset.svg ) {

						let pattern = backgroundPatterns[ block.dataset.svg ];

						block.style.backgroundImage = backgroundSvgUrl(
							pattern.svg,
							color,
							opacity
						);
					}
				} );
			} );
		} );

		wp.customize.control( `${type}_background_svg`, control => {

			control.setting.bind( svg => {

				if ( svg ) {
					wp.customize.control( `color_${type}_background_fill` ).activate();
					wp.customize.control( `${type}_background_fill_opacity` ).activate();
				} else {
					wp.customize.control( `color_${type}_background_fill` ).deactivate();
					wp.customize.control( `${type}_background_fill_opacity` ).deactivate();
				}

			} );
		} );
	} );
} );
