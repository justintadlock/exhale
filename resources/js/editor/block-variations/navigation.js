export default {
	block      : 'core/navigation',
	variations : [
		{
			name: 'primary',
			title: 'Navigation: Primary',
			scope: [
				'block',
				'inserter',
				'transform'
			],
			attributes: {
				orientation: 'primary-horizontal',
				isResponsive: true,
				className: 'menu--primary'
			},
			innerBlocks: [
				[ 'core/home-link', { label: 'Home' } ],
				[ 'core/navigation-link', { label: 'About', url: '/about', kind: 'custom' } ],
				[ 'core/navigation-link', { label: 'Blog', url: '/blog', kind: 'custom' } ]
			]
		}
	]
};
