/**
 * Custom header preview.
 *
 * This file handles the JavaScript for the live preview of the `custom-header`
 * feature in the customizer.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

function setProp( prop, func, amt ) {

	if ( ! func || 'none' === func ) {
		document.documentElement.style.setProperty( prop, 'none' );
	} else {
		document.documentElement.style.setProperty(
			prop,
			func + '(' + amt + '%)'
		);
	}
}

let functionSetting      = 'image_default_filter_function';
let defaultAmountSetting = 'image_default_filter_amount';
let hoverAmountSetting   = 'image_hover_filter_amount';

wp.customize( functionSetting, setting => {

	setting.bind( to => {
		let defaultAmount = wp.customize( defaultAmountSetting ).get();
		let hoverAmount   = wp.customize( hoverAmountSetting   ).get();

		setProp( '--image-default-filter', to, defaultAmount );
		setProp( '--image-hover-filter',   to, hoverAmount   );
	} );
} );

wp.customize( defaultAmountSetting, setting => {

	setting.bind( to => {
		let func = wp.customize( functionSetting ).get();

		setProp( '--image-default-filter', func, to );
	} );
} );

wp.customize( hoverAmountSetting, setting => {

	setting.bind( to => {
		let func = wp.customize( functionSetting ).get();

		setProp( '--image-hover-filter', func, to );
	} );
} );
