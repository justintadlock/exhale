/**
 * Box Shadow Control.
 *
 * Outputs a select dropdown control for handling the box-shadow.
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
		{ label: labels.default,          value: ''            },
		{ label: labels.none,             value: 'none'        },
		{ label: labels.sizes.small,      value: 'small'       },
		{ label: labels.sizes.medium,     value: 'medium'      },
		{ label: labels.sizes.large,      value: 'large'       },
		{ label: labels.sizes.extraLarge, value: 'extra-large' }
	];

	// Get the box-shadow attribute.
	let { boxShadow } = props.attributes;

	// Replace the class name based on the box-shadow value.
	props.attributes.className = updateClass(
		props.attributes.className,
		boxShadow ? 'shadow-' + boxShadow : '',
		options.filter( opt => opt.value ).map( opt => 'shadow-' + opt.value )
	);

	return (
		<SelectControl
			key="boxShadow"
			label={ labels.shadow }
			value={ boxShadow }
			options={ options }
			onChange={ ( selected ) => {
				props.setAttributes( {
					boxShadow: selected,
				} );
			} }
		/>
	);
};
