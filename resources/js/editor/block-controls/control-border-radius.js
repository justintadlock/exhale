/**
 * Border Radius Control.
 *
 * Outputs a select dropdown control for handling the border-radius.
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
		{ label: labels.default,         value: ''            },
		{ label: labels.none,            value: 'none'        },
		{ label: labels.sizes.small,     value: 'small'       },
		{ label: labels.sizes.medium,    value: 'medium'      },
		{ label: labels.sizes.large,     value: 'large'       },
		{ label: labels.size.extraLarge, value: 'extra-large' }
	];

	// Get the border-radius attribute.
	let { borderRadius } = props.attributes;

	// Replace the class name based on the border-radius value.
	props.attributes.className = updateClass(
		props.attributes.className,
		borderRadius ? 'rounded-' + borderRadius : '',
		options.filter( opt => opt.value ).map( opt => 'rounded-' + opt.value )
	);

	return (
		<SelectControl
			key="borderRadius"
			label={ labels.borderRadius }
			value={ borderRadius }
			options={ options }
			onChange={ ( selected ) => {
				props.setAttributes( {
					borderRadius: selected,
				} );
			} }
		/>
	);
};
