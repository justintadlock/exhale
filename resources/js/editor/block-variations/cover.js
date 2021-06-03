export default {
	block      : 'core/cover',
	variations : [

		// Creates a default Cover variation that uses the correct
		// default paragraph font size. Core's use of the "large"
		// size should be a variation itself since it is an opionated
		// style, and not all themes have a "large" size.
		{
			name: 'default',
			title: 'Cover',
			scope: [
				'block',
				'inserter',
				'transform'
			],
			isDefault: true,
			attributes: {
				className: 'is-default'
			},
			innerBlocks: 	[
				[ 'core/paragraph', { align: 'center' } ]
			]
		}
	]
};
