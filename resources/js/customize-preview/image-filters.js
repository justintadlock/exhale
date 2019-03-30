/**
 * Custom header preview.
 *
 * This file handles the JavaScript for the live preview of the `custom-header`
 * feature in the customizer.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

let filterSettings = [
	'image_default',
	'image_hover'
];

let properties = {
	image_default : '--image-default-filter',
	image_hover   : '--image-hover-filter'
};

function setProp( filterSetting, func, amt ) {
	document.documentElement.style.setProperty(
		properties[ filterSetting ],
		func + '(' + amt + '%)'
	);
}

filterSettings.forEach( filterSetting => {

	let functionSetting = filterSetting + '_filter_function';
	let amountSetting   = filterSetting + '_filter_amount';

	wp.customize( functionSetting, setting => {

		setting.bind( to => {
			let amount = wp.customize( amountSetting ).get();

			setProp( filterSetting, to, amount );
		} );
	} );

	wp.customize( amountSetting, setting => {

		setting.bind( to => {
			let func = wp.customize( functionSetting ).get();

			setProp( filterSetting, func, to );
		} );
	} );
} );
