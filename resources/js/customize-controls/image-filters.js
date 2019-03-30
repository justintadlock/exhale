// Passed in via `wp_localize_script()`.
let filters = exhaleCustomizeControls.imageFilters;

wp.customize.controlConstructor['exhale-image-filter'] = wp.customize.Control.extend( {

	ready : function() {

		let control             = this;
		let filterFunction      = control.settings.function;
		let filterDefaultAmount = control.settings.default_amount;
		let filterHoverAmount   = control.settings.hover_amount;

		filterFunction.bind( value => {

			let min    = filters[ value ].min;
			let max    = filters[ value ].max;
			let lacuna = filters[ value ].lacuna;

			let defaultAmountSelector = control.selector + ' [data-customize-setting-link=' + filterDefaultAmount.id + ']';
			let hoverAmountSelector   = control.selector + ' [data-customize-setting-link=' + filterHoverAmount.id   + ']';

			// Ideally, this should be used before rerendering the
			// control, but it doesn't seem to do anything for now.
			//control.params.amount.min    = min;
			//control.params.amount.max    = max;
			//control.params.amount.lacuna = lacuna;

			filterDefaultAmount.set( lacuna );
			filterHoverAmount.set( lacuna );

			let inputs = document.querySelectorAll(
				defaultAmountSelector + ',' + hoverAmountSelector
			);

			inputs.forEach( input => {
				input.setAttribute( 'min', min );
				input.setAttribute( 'max', max );
			} );

		} );
	}
} );
