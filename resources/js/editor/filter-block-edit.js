/**
 * Block Edit Filter.
 *
 * Adds a filter on `editor.BlockEdit` and adds custom inspector controls to
 * any blocks that has custom design settings.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

// Imports the design setting fields.
import fields from './block-controls/fields';

// Imports the design settings panel.
import PanelDesignSettings from './block-controls/panel-design-settings';

// Assign core WP variables.
const { createHigherOrderComponent } = wp.compose;
const { Fragment }                   = wp.element;
const { InspectorControls }          = wp.blockEditor;
const { addFilter }                  = wp.hooks;

/**
 * Filter on block edit to add custom inspector controls.
 *
 * @since  2.1.0
 * @access public
 * @param  object   BlockEdit
 * @return function
 */
const ExhaleBlockEdit = createHigherOrderComponent( ( BlockEdit ) => {

	return ( props ) => {

		// Create an array to hold the fields for the current block.
		let blockFields = [];

		// Loop through the global fields and add them to the block
		// fields array if they belong to the current block. `props.name`
		// is the current block ID.
		fields.forEach( field => {
			if ( field.blocks.includes( props.name ) ) {
				blockFields.push( field );
			}
		} );

		// If there are no fields for the current block, return the
		// block edit component.
		if ( ! blockFields.length ) {
			return (
				<BlockEdit { ...props } />
			);
		}

		// Insert a new design settings panel and pass along the fields
		// to display.
		return (
			<Fragment>
				<BlockEdit { ...props } />
				<InspectorControls>
					{ PanelDesignSettings( props, blockFields ) }
				</InspectorControls>
			</Fragment>
		);
	};

}, 'ExhaleBlockEdit' );

addFilter( 'editor.BlockEdit', 'exhale/block/edit', ExhaleBlockEdit );
