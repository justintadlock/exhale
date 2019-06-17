/**
 * Footer controls.
 *
 * Activates or deactivates the footer credit section based on whether the
 * "powered by" setting is true/false.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

wp.customize.control( 'powered_by', control => {

	control.setting.bind( value => {
		let footerCredit = wp.customize.control( 'footer_credit' );

		value ? footerCredit.deactivate() : footerCredit.activate();
	} );
} );
