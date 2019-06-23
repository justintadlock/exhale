/**
 * Separator Block Styles.
 *
 * This file exports all of the styles for the separator block.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

let labels = exhaleEditor.labels;

export default {
	name  : 'core/separator',
	styles : [
		{
			name  : 'dashed',
			label : labels.borderDashed
		},
		{
			name  : 'double',
			label : labels.borderDouble
		}
	]
};
