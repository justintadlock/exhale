// Passed in via `wp_localize_script()`.
let filters = exhaleCustomizeControls.imageFilters;

wp.customize.controlConstructor['exhale-image-filter'] = wp.customize.Control.extend( {

	ready : function() {

		let control        = this;
		let filterFunction = control.settings.function;
		let filterAmount   = control.settings.amount;

		filterFunction.bind( value => {

			let min    = filters[ value ].min;
			let max    = filters[ value ].max;
			let lacuna = filters[ value ].lacuna;

			// Ideally, this should be used before rerendering the
			// control, but it doesn't seem to do anything for now.
			control.params.amount.min    = min;
			control.params.amount.max    = max;
			control.params.amount.lacuna = lacuna;

			filterAmount.set( lacuna );

			let input = document.querySelector(
				control.selector + ' [data-customize-setting-link=' + filterAmount.id + ']'
			);

			input.setAttribute( 'min', min );
			input.setAttribute( 'max', max );
		} );
	}
} );
