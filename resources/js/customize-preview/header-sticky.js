
// Sticky header.
wp.customize( 'header_sticky', value => {
	value.bind( to => {

		let classes = [
			'sticky',
			'md:static'
		];

		let header = document.querySelector( '.app-header' );

		header.classList.remove( ...classes );

		to ? header.classList.add( 'sticky' ) : header.classList.add( ...classes );
	} );
} );
