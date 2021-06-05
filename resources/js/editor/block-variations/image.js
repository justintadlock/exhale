export default {
	block      : 'core/image',
	variations : [
		{
			name: 'default',
			title: 'Image: Classic',
			scope: 'transform',
			isDefault: true,
			attributes: {
				className: 'is-var-classic'
			}
		},
		{
			name: 'classic',
			title: 'Image: Overlay',
			scope: [
				'block',
				'inserter',
				'transform'
			],
			attributes: {
				className: 'is-var-overlay'
			}
		}
	]
};
