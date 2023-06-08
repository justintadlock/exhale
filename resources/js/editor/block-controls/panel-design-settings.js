/**
 * Design Settings Panel.
 *
 * Creates the design settings panel for the block editor.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

const { PanelBody } = wp.components;
const { __ } = wp.i18n;

// Global set via `wp_localize_script()`.
const { labels } = exhaleEditor;

export default ( props, fields ) => {

	return (
		<PanelBody title={ labels.designSettings } initialOpen={ false }>
			{
				fields.map( ( field, i ) => {
					return field.control( props )
				} )
			}
		</PanelBody>
	);
};
