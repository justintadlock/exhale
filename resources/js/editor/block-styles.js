
// WordPress dependencies.
const { __ } = wp.i18n;

wp.domReady( () => {

	wp.blocks.registerBlockStyle( 'core/image', {
		name      : 'default',
		label     : __( 'Bordered', 'exhale' ),
		isDefault : true
	} );

	wp.blocks.registerBlockStyle( 'core/image', {
		name  : 'borderless',
		label : __( 'No Border', 'exhale' )
	} );

} );
