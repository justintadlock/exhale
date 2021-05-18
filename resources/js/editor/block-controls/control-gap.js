/**
 * List Style Type Control.
 *
 * Outputs a select dropdown control for handling the list-style-type.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
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
		{ label: labels.default, value: '' },
		{ label: 'Gap 0', value: '0' },
		{ label: 'Gap 4', value: '4' },
		{ label: 'Gap 8', value: '8' },
		{ label: 'Gap 12', value: '12' },
		{ label: 'Gap 16', value: '16' }
	];

	// Get the gap attribute.
	let { gap } = props.attributes;

	return (
		<SelectControl
			key="gap"
			label={ 'Gap' }
			value={ gap }
			options={ options }
			onChange={ ( selected ) => {
				props.setAttributes( {
					gap: selected,
					className: updateClass(
						props.attributes.className,
						selected ? 'gap-' + selected : '',
						options.filter( opt => opt.value ).map( opt => 'gap-' + opt.value )
					)
				} );
			} }
		/>
	);
};
