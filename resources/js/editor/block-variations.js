import * as blockVariations from './block-variations/index';

wp.domReady( () => {

	Object.keys( blockVariations ).forEach( block => {

		blockVariations[ block ].variations.forEach( options => {

		//	console.log( options );
		//	console.log( blockVariations[ block ].block );

			wp.blocks.registerBlockVariation(
				blockVariations[ block ].block,
				options
			);

		} );

	} );

} );
