export default {
	block      : 'core/spacer',
	variations : [
		{
			name: 'default',
			title: 'Spacer',
			scope: [ 'block', 'inserter', 'transform' ],
			attributes: { height: 100 },
			isDefault: true
		},
		{
			name: 'spacing-1',
			title: 'Theme Spacer: 1 (0.25rem)',
			scope: [ 'transform' ],
			attributes: { height: 4 },
			isActive: ( block, variation ) => block.height === variation.height
		},
		{
			name: 'spacing-2',
			title: 'Theme Spacer: 2 (0.5rem)',
			scope: [ 'transform' ],
			attributes: { height: 8 },
			isActive: ( block, variation ) => block.height === variation.height
		},
		{
			name: 'spacing-3',
			title: 'Theme Spacer: 3 (0.75rem)',
			scope: [ 'transform' ],
			attributes: { height: 12 },
			isActive: ( block, variation ) => block.height === variation.height
		},
		{
			name: 'spacing-4',
			title: 'Theme Spacer: 4 (1rem)',
			scope: [ 'transform' ],
			attributes: { height: 16 },
			isActive: ( block, variation ) => block.height === variation.height
		},
		{
			name: 'spacing-5',
			title: 'Theme Spacer: 5 (1.25rem)',
			scope: [ 'transform' ],
			attributes: { height: 20 },
			isActive: ( block, variation ) => block.height === variation.height
		},
		{
			name: 'spacing-6',
			title: 'Theme Spacer: 6 (1.5rem)',
			scope: [ 'transform' ],
			attributes: { height: 24 },
			isActive: ( block, variation ) => block.height === variation.height
		},
		{
			name: 'spacing-8',
			title: 'Theme Spacer: 8 (2rem)',
			scope: [ 'transform' ],
			attributes: { height: 32 },
			isActive: ( block, variation ) => block.height === variation.height
		},
		{
			name: 'spacing-12',
			title: 'Theme Spacer: 12 (3rem)',
			scope: [ 'transform' ],
			attributes: { height: 48 },
			isActive: ( block, variation ) => block.height === variation.height
		},
		{
			name: 'spacing-16',
			title: 'Theme Spacer: 16 (4rem)',
			scope: [ 'transform' ],
			attributes: { height: 64 },
			isActive: ( block, variation ) => block.height === variation.height
		},
		{
			name: 'spacing-20',
			title: 'Theme Spacer: 20 (5rem)',
			scope: [ 'transform' ],
			attributes: { height: 80 },
			isActive: ( block, variation ) => block.height === variation.height
		},
		{
			name: 'spacing-24',
			title: 'Theme Spacer: 24 (6rem)',
			scope: [ 'block' ],
			attributes: { height: 96 },
			isActive: ( block, variation ) => block.height === variation.height
		},
		{
			name: 'spacing-28',
			title: 'Theme Spacer: 28 (7rem)',
			scope: [ 'transform' ],
			attributes: { height: 112 },
			isActive: ( block, variation ) => block.height === variation.height
		},
		{
			name: 'spacing-32',
			title: 'Theme Spacer: 32 (8rem)',
			scope: [ 'transform' ],
			attributes: { height: 128 },
			isActive: ( block, variation ) => block.height === variation.height
		},
		{
			name: 'spacing-36',
			title: 'Theme Spacer: 36 (9rem)',
			scope: [ 'transform' ],
			attributes: { height: 144 },
			isActive: ( block, variation ) => block.height === variation.height
		},
		{
			name: 'spacing-40',
			title: 'Theme Spacer: 40 (10rem)',
			scope: [ 'transform' ],
			attributes: { height: 160 },
			isActive: ( block, variation ) => block.height === variation.height
		}
	]
};
