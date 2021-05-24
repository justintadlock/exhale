export default {
	block      : 'core/gallery',
	variations : [
		{
			name: 'default',
			title: 'Gallery: Default',
			scope: 'transform',
			isDefault: true,
			attributes: {
				className: 'is-default'
			}
		},
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
			}
		}
	]
};
