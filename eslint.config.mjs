import antfu from '@antfu/eslint-config';

export default antfu(
	{
		typescript : false,
		// `.eslintignore` is no longer supported in Flat config, use `ignores` instead.
		ignores    : [
			'dist/js/**/*.js',
		],
	},
	// From the second arguments they are ESLint Flat Configs
	// you can have multiple configs.
	{
		rules: {
			'style/space-in-parens' : [ 'error', 'always' ],
			'style/wrap-iife'       : 'off',
			'jsdoc/empty-tags'      : 'off',
			'semi'                  : [
				'error',
				'always',
				{
					omitLastInOneLineBlock     : false,
					omitLastInOneLineClassBody : false,
				},
			],
			'style/semi'              : [ 'error', 'always' ],
			'curly'                   : [ 'error', 'multi-line' ],
			// ESLint's automatic indentation fixes are inconsistent and unreliable,
			// so indentation is being managed via .editorconfig instead.
			// The relevant rules are turned off to prevent conflicts.
			// For context, see: https://github.com/typescript-eslint/typescript-eslint/issues/1824
			'style/indent'            : 'off',
			'style/indent-binary-ops' : 'off',
			'style/no-tabs'           : 'off',
			'style/no-multi-spaces'   : [ 'warn', {
				ignoreEOLComments : false,
				exceptions        : {
					VariableDeclarator   : true, // Allows alignment for variable assignments
					ImportDeclaration    : true, // Allows alignment for imports
					Property             : true, // Allows alignment for object properties
					AssignmentExpression : true, // Allows alignment for assignment expressions
				},
			} ],
			'style/key-spacing': [ 'error', {
				align: {
					beforeColon : true,
					afterColon  : true,
					on          : 'colon',
				},
			} ],
			'style/array-bracket-spacing'      : [ 'error', 'always' ],
			'style/object-curly-spacing'       : [ 'error', 'always' ],
			'no-unused-vars'                   : 'off',
			'unused-imports/no-unused-imports' : 'off',
			'unused-imports/no-unused-vars'    : [
				'warn',
				{
					vars              : 'all',
					varsIgnorePattern : '^_',
					args              : 'after-used',
					argsIgnorePattern : '^_',
				},
			],
			'prefer-const'          : 'off',
			'yoda'                  : 'off',
			'prefer-arrow-callback' : 'off',
			'style/brace-style'     : [ 'error', '1tbs', { allowSingleLine: true } ],
		},
	},
);
