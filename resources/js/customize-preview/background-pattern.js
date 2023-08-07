// Global set via `wp_localize_script()`.
const { backgroundPatterns } = exhaleCustomizePreview;

let types = {
	body: 'body',
	header: '.app-header',
	content: '.app-content',
	footer: '.app-footer',
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

	wp.customize( `${type}_background_image`, value => {

		value.bind( to => {

			console.log( to );

			container.style.backgroundImage = '';

			// Add new background image.
			if ( to ) {
				container.style.backgroundImage = 'url("' + to + '")';
			}
		} );
	} );

	wp.customize( `${type}_background_svg`, value => {

		value.bind( to => {

			container.style.backgroundImage = '';

			// Add new background image.
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

	wp.customize( `${type}_background_attachment`, value => {

		value.bind( to => {

			let attachments = [
				'bg-scroll',
				'bg-fixed',
				'bg-local'
			];

			// Add new attachment class.
			if ( to ) {
				container.classList.remove( ...attachments );

				container.classList.add( `bg-${ to }` );
			}
		} );
	} );

	wp.customize( `${type}_background_size`, value => {

		value.bind( to => {

			let sizes = [
				'bg-auto',
				'bg-cover',
				'bg-contain'
			];

			// Add new size class.
			if ( to ) {
				container.classList.remove( ...sizes );

				container.classList.add( `bg-${ to }` );
			}
		} );
	} );

	wp.customize( `${type}_background_repeat`, value => {

		value.bind( to => {

			let repeats = [
				'bg-no-repeat',
				'bg-repeat',
				'bg-repeat-x',
				'bg-repeat-y'
			];

			// Add new repeat class.
			if ( to ) {
				container.classList.remove( ...repeats );

				container.classList.add( `bg-${ to }` );
			}
		} );
	} );

	wp.customize( `${type}_background_position`, value => {

		value.bind( to => {

			let positions = [
				'bg-bottom',
				'bg-center',
				'bg-left',
				'bg-left-bottom',
				'bg-left-top',
				'bg-right',
				'bg-right-bottom',
				'bg-right-top',
				'bg-top'
			];

			// Add new position class.
			if ( to ) {
				container.classList.remove( ...positions );

				container.classList.add( `bg-${ to }` );
			}
		} );
	} );
} );
