
let families = exhaleCustomizeControls.fontFamilyChoices;
let styles   = exhaleCustomizeControls.fontStyles;

wp.customize.controlConstructor['exhale-font'] = wp.customize.Control.extend( {

	ready : function() {

		let control = this;
		let family  = control.settings.family;
		let style   = control.settings.style;

		if ( style ) {

			//renderOptions( style.get() );

			family.bind( value => {
				renderOptions( value );
			} );
		}

		let renderOptions = function( value ) {

			let select = document.querySelector(
				control.selector + ' [data-customize-setting-link=' + style.id + ']'
			);

			let valueStyles = families[ value ].styles;

			let i;

			for ( i = select.options.length - 1 ; i >= 0 ; i-- ) {
				select.remove( i );
			}

			let optValue = '400';

			if ( valueStyles.indexOf( style.get() ) !== -1 ) {
				optValue = style.get();
			} else {
				optValue = valueStyles[0];
			}

			style.set( optValue );

			valueStyles.forEach( styleName => {
				let opt       = document.createElement( 'option' );
				opt.value     = styleName;
				opt.innerHTML = styles[ styleName ].label;

				if ( styleName === optValue ) {
					opt.setAttribute( 'selected', 'selected' );
				}

				select.appendChild( opt );
			} );
		};
	}
} );


wp.customize.control( 'font_family_headings', control => {

	let families = exhaleCustomizeControls.fontFamilyChoices;
	let styles   = exhaleCustomizeControls.fontStyles;

	control.setting.bind( value => {
		let styleControl = wp.customize.control( 'font_style_headings' );

		let styleSetting = styleControl.settings.default;

		//console.log( styleSetting );

		let newStyles = {};

		let valueStyles = families[ value ].styles;

		let select = document.querySelector(
			styleControl.selector + ' [data-customize-setting-key-link=default]'
		);

		var i;
		for ( i = select.options.length - 1 ; i >= 0 ; i-- ) {
			select.remove( i );
		}

		let optValue = '400';

		if ( valueStyles.indexOf( styleSetting.get() ) !== -1 ) {
			optValue = styleSetting.get();
		} else {
			optValue = valueStyles[0];
		}

		styleSetting.set( optValue );

		valueStyles.forEach( styleName => {
			let opt = document.createElement( 'option' );
			opt.value = styleName;
			opt.innerHTML = styles[ styleName ].label;

			if ( styleName === optValue ) {
				opt.setAttribute( 'selected', 'selected' );
			}

			select.appendChild( opt );
		//	newStyles[ styleName ] = styles[ styleName ].label;
		} );

	} );
} );
