export default {
	block      : 'core/gallery',
	variations : [
		{
			name: 'classic',
			title: 'Gallery: Classic',
			scope: [
				'block',
				'inserter',
				'transform'
			],
			attributes: {
				className: 'is-classic'
			},
			isActive: ( block, variation ) => block.className.includes( variation.className )
		},
		{
			name: 'default',
			title: 'Gallery: Overlay',
			scope: 'transform',
			isDefault: true,
			attributes: {
				className: 'is-default'
			}
		}
	]
};
