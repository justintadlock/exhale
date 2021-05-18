
const { registerFormatType, toggleFormat } = wp.richText;
const { RichTextToolbarButton } = wp.blockEditor;

const FormatUnderlineButton = ( props ) => {
	return (
		<RichTextToolbarButton
			icon="underline"
			title="Underline"
			onClick={ () => {
				props.onChange(
					toggleFormat( props.value, {
						type: 'exhale/underline'
					} )
				);
			} }
			isActive={ props.isActive }
		/>
	);
};

registerFormatType( 'exhale/underline', {
	title: 'Small',
	tagName: 'span',
	className: 'underline',
	edit: FormatUnderlineButton
} );
