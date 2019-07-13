<?php
/**
 * Footer service provider.
 *
 * Bootstraps the Footer component.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Footer;

use Hybrid\Tools\ServiceProvider;

/**
 * Footer service provider class.
 *
 * @since  2.1.0
 * @access public
 */
class Provider extends ServiceProvider {

	/**
	 * Binds components to the container.
	 *
	 * @since  2.1.0
	 * @access public
	 * @return void
	 */
	public function register() {
		$this->app->singleton( Customize::class );
	}
}
