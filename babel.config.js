const presets = [];

const plugins = [
	[
		'@babel/plugin-transform-react-jsx',
		{
			pragma: 'wp.element.createElement',
		},
	],
	'@babel/plugin-transform-class-properties',
];

module.exports = { presets, plugins, sourceType: 'unambiguous' };
