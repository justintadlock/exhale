/**
 * Block Design Setting Fields.
 *
 * Returns an array of design setting fields to output in the block editor.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

// Import block controls.
import ControlBoxShadow    from './control-box-shadow';
import ControlGap          from './control-gap';
import ControlListType     from './control-list-type';

export default [
	{
		name:    'listType',
		type:    'string',
		default: '',
		control: ControlListType,
		blocks:  [
			'core/list'
		]
	},
	{
		name:    'borderRadius',
		type:    'string',
		default: '',
		control: ControlBorderRadius,
		blocks:  [
			'core/image',
			'core/gallery',
			'core/group',
			'core/media-text',
			'core/paragraph'
		]
	},
	{
		name:    'boxShadow',
		type:    'string',
		default: '',
		control: ControlBoxShadow,
		blocks:  [
			'core/column',
			'core/group',
			'core/image',
			'core/gallery',
			'core/media-text',
			'core/paragraph'
		]
	},
	{
		name:    'gap',
		type:    'string',
		default: '',
		control: ControlGap,
		blocks:  [
			'core/query-loop'
		]
	}
];
