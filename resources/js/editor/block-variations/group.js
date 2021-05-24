export default {
	block      : 'core/group',
	variations : [
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
					fontSize:"small"
				} ]
			]
		}
	]
};
