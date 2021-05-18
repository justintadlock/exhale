
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
						type: 'exhale/font-size-small'
					} )
				);
			} }
			isActive={ props.isActive }
		/>
	);
};

registerFormatType( 'exhale/font-size-small', {
	title: 'Small',
	tagName: 'span',
	className: 'has-small-font-size',
	edit: FormatFontSizeSmallButton
} );
