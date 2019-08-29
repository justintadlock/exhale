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

import * as blockStyles from './block-styles/index';

wp.domReady( () => {

	Object.keys( blockStyles ).forEach( block => {

		blockStyles[ block ].styles.forEach( options => {

			wp.blocks.registerBlockStyle(
				blockStyles[ block ].name,
				options
			);

		} );

	} );

	// Unregisters the circle-mask style added in Gutenber 6.4.0.  We may
	// revisit this in the future.

	wp.blocks.unregisterBlockStyle( 'core/image', 'circle-mask' );

} );
