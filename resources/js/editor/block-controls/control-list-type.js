/**
 * List Style Type Control.
 *
 * Outputs a select dropdown control for handling the list-style-type.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

// Import the class update utility.
import updateClass from './../util/update-class';

// Get the core WP select control.
const { SelectControl } = wp.components;

// Global set via `wp_localize_script()`.
const { labels } = exhaleEditor;

export default ( props ) => {

	let options = [
		{ label: labels.default,      value: ''       },
		{ label: labels.none,         value: 'none'   },
		{ label: labels.lists.disc,   value: 'disc'   },
		{ label: labels.lists.circle, value: 'circle' },
		{ label: labels.lists.square, value: 'square' },
	];

	// Get the list-style-type attribute.
	let { listType } = props.attributes;

	return (
		<SelectControl
			key="listType"
			label={ labels.listType }
			value={ listType }
			options={ options }
			onChange={ ( selected ) => {
				props.setAttributes( {
					listType: selected,
					className: updateClass(
						props.attributes.className,
						selected ? 'list-' + selected : '',
						options.filter( opt => opt.value ).map( opt => 'list-' + opt.value )
					)
				} );
			} }
		/>
	);
};
