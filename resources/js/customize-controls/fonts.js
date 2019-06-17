
let families = exhaleCustomizeControls.fontFamilies;
let styles   = exhaleCustomizeControls.fontStyles;

wp.customize.controlConstructor['exhale-font'] = wp.customize.Control.extend( {

	ready : function() {

		let control       = this;
		let familySetting = control.settings.family;
		let styleSetting  = control.settings.style;

		if ( styleSetting ) {

			familySetting.bind( value => {

				let family = families[ value ];

				let select = document.querySelector(
					control.selector + ' [data-customize-setting-link=' + styleSetting.id + ']'
				);

				let i;

				for ( i = select.options.length - 1 ; i >= 0 ; i-- ) {
					select.remove( i );
				}

				let optValue = family.styles[0];

				if ( family.styles.indexOf( styleSetting.get() ) !== -1 ) {
					optValue = styleSetting.get();
				}

				styleSetting.set( optValue );

				family.styles.forEach( styleName => {

					let opt       = document.createElement( 'option' );
					opt.value     = styleName;
					opt.innerHTML = styles[ styleName ].label;

					if ( styleName === optValue ) {
						opt.setAttribute( 'selected', 'selected' );
					}

					select.appendChild( opt );
				} );
			} );
		}
	}
} );
