export default {
	block      : 'core/group',
	variations : [
		{
			name: 'default',
			title: 'Group: Default',
			scope: [
				'block',
				'inserter',
				'transform'
			],
			isDefault: true
		},
		{
			name: 'padded',
			title: 'Group: Padded',
			scope: [
				'block',
				'inserter',
				'transform'
			],
			isDefault: true,
			attributes: {
				style: {
					spacing: {
						padding: {
							top: "2rem",
							bottom: "2rem",
							left: "2rem",
							right: "2rem"
						}
					}
				},
				backgroundColor: 'neutral-100',
				className: 'is-var-padded'
			},
			innerBlocks: 	[
				[ 'core/paragraph', { align: 'center' } ]
			]
		},
		{
			name: 'site-branding',
			title: 'Site Branding',
			scope: [
				'inserter'
			],
			attributes: {
				align: "full",
				style: {
					spacing: {
						padding: {top:"0rem",right:"2rem",bottom:"0rem",left:"2rem"},
						margin:   {top:"0px",right:"0px",bottom:"0px",left:"0px"}
					}
				},
				className:"overflow-hidden flex justify-start items-center md:flex-grow-0"
			},
			innerBlocks: [
				[ "core/site-title", {
					className:"m-0 mr-2 leading-none",
					style: {
						typography:{
							lineHeight:"1"
						},
						spacing: {
							margin: {top:"0px",right:"8px",bottom:"0px",left:"0px"}
						}
					},
					fontSize:"extra-large"
				} ],
				[ "core/site-tagline", {
					style: {
						typography:{
							fontFamily:"var:preset|font-family|secondary",
							lineHeight:"1"
						},
						spacing:{
							margin:{top:"0px",right:"0px",bottom:"0px",left:"8px"}
						}
					},
					className:"hidden sm:block",
					fontSize:"sm"
				} ]
			]
		}
	]
};
