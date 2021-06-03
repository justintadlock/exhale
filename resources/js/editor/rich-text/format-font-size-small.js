
const { registerFormatType, toggleFormat } = wp.richText;
const { RichTextToolbarButton } = wp.blockEditor;

const FormatFontSizeSmallButton = ( props ) => {
	return (
		<RichTextToolbarButton
			icon="verse"
			title="Small"
			onClick={ () => {
				props.onChange(
					toggleFormat( props.value, {
						type: 'exhale/font-size-sm'
					} )
				);
			} }
			isActive={ props.isActive }
		/>
	);
};

registerFormatType( 'exhale/font-size-sm', {
	title: 'Small',
	tagName: 'span',
	className: 'has-sm-font-size',
	edit: FormatFontSizeSmallButton
} );
