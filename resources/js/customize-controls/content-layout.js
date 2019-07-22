
// Global set via `wp_localize_script()`.
const { loopLayouts, loopQueries, imageSizes } = exhaleCustomizeControls;

Object.values( loopQueries ).forEach( type => {

	wp.customize.control( `loop_${type}_layout`, control => {

		control.setting.bind( layout => {

			// Activate/Deactivate the width and columns controls, depending
			// on whether the current layout supports them.

			let widthControl   = wp.customize.control( `loop_${type}_width`   );
			let columnsControl = wp.customize.control( `loop_${type}_columns` );

			loopLayouts[ layout ].supportsWidth
				? widthControl.activate()
				: widthControl.deactivate();

			loopLayouts[ layout ].supportsColumns
				? columnsControl.activate()
				: columnsControl.deactivate();

			// Activate/Deactivate the featured image control, depending on
			// whether the layout supports them.  If the layout does support
			// featured images, only display the featured image sizes that
			// the layout supports.

			let featuredImageControl = wp.customize.control( `loop_${type}_image_size` );
			let featuredImageSetting = featuredImageControl.settings.default;

			if ( ! loopLayouts[ layout ].imageSizes.length ) {

				featuredImageControl.deactivate();

			} else {

				let select = document.querySelector(
					featuredImageControl.selector + ' [data-customize-setting-link=' + featuredImageSetting.id + ']'
				);

				// Remove all options from the select. We're going to
				// rebuild it below.
				for ( let i = select.options.length; i >= 0 ; i-- ) {
					select.remove( i );
				}

				// Set the selected option. If the current option is
				// supported by the layout, use it. Otherwise, use the
				// first available featured image size.

				let selectedOption = loopLayouts[ layout ].imageSizes[0];

				if ( loopLayouts[ layout ].imageSizes.includes( featuredImageSetting.get() ) ) {
					selectedOption = featuredImageSetting.get();
				}

				featuredImageSetting.set( selectedOption );

				loopLayouts[ layout ].imageSizes.forEach( size => {

					let opt       = document.createElement( 'option' );
					opt.value     = size;
					opt.innerHTML = imageSizes[ size ].label;

					if ( size === selectedOption ) {
						opt.setAttribute( 'selected', 'selected' );
					}

					select.appendChild( opt );

				} );

				featuredImageControl.activate();
			}

		} );
	} );
} );
