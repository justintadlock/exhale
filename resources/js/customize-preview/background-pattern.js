// Global set via `wp_localize_script()`.
const { backgroundPatterns } = exhaleCustomizePreview;

let types = {
	header:         '.app-header',
	content:        '.app-content',
	footer:         '.app-footer',
	sidebar_footer: '.sidebar--footer'
};

const backgroundSvgUrl = ( svg, fill, opacity ) => {

	let url = svg.replace( /fill="#[a-fA-F0-9_-]*"/, 'fill="' + fill + '"' )
		     .replace( /fill-opacity="[0-9.]*"/, 'fill-opacity="' + opacity + '"' )
		     .replace( /\"/g, '\''  )
		     .replace( /\</g, '%3C' )
		     .replace( /\>/g, '%3E' )
		     .replace( /\&/g, '%26' )
		     .replace( /\#/g, '%23' );

	let css = 'url("data:image/svg+xml,' + url + '")';

	console.log( css );

	return css;
};

Object.keys( types ).forEach( ( type ) => {

	let container = document.querySelector( types[ type ] );

	if ( ! container ) {
		return;
	}

	wp.customize( `${type}_background_svg`, value => {

		value.bind( to => {

			container.style.backgroundImage = '';

			// Add new layout class.
			if ( to ) {
				let pattern = backgroundPatterns[ to ];
				let color   = wp.customize( `color_${type}_background_fill` ).get();
				let opacity = wp.customize( `${type}_background_fill_opacity` ).get();

				container.style.backgroundImage = backgroundSvgUrl(
					pattern.svg,
					color,
					opacity
				);
			}
		} );
	} );

	wp.customize( `color_${type}_background_fill`, value => {

		value.bind( to => {

			container.style.backgroundImage = '';

			// Add new layout class.
			if ( to ) {
				let svg = wp.customize( `${type}_background_svg` ).get();

				if ( svg ) {
					let pattern = backgroundPatterns[ svg ];
					let color   = to;
					let opacity = wp.customize( `${type}_background_fill_opacity` ).get();

					container.style.backgroundImage = backgroundSvgUrl(
						pattern.svg,
						color ? color : 'transparent',
						opacity
					);
				}
			}
		} );
	} );

	wp.customize( `${type}_background_fill_opacity`, value => {

		value.bind( to => {

			container.style.backgroundImage = '';

			// Add new layout class.
			if ( to ) {

				let svg = wp.customize( `${type}_background_svg` ).get();

				if ( svg ) {
					let pattern = backgroundPatterns[ svg ];
					let color   = wp.customize( `color_${type}_background_fill` ).get();
					let opacity = to;

					container.style.backgroundImage = backgroundSvgUrl(
						pattern.svg,
						color ? color : 'transparent',
						opacity
					);
				}
			}
		} );
	} );
} );
