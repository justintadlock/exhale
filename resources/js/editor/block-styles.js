/**
 * Editor block styles.
 *
 * This file handles the JavaScript for creating block styles in the editor.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

// WordPress dependencies.
// const { __ } = wp.i18n;

wp.domReady( () => {

	let labels = exhaleEditor.labels;

	wp.blocks.registerBlockStyle( 'core/image', {
		name      : 'default',
		label     : labels.border,
		isDefault : true
	} );

	wp.blocks.registerBlockStyle( 'core/image', {
		name  : 'borderless',
		label : labels.borderless,
	} );

} );
