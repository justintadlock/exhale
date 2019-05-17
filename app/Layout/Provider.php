<?php
/**
 * Layout Service Provider.
 *
 * Bootstraps the layout components.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Layout;

use Hybrid\Tools\ServiceProvider;
use Exhale\Tools\CustomProperties;

/**
 * Layout service provider class.
 *
 * @since  1.2.0
 * @access public
 */
class Provider extends ServiceProvider {

	/**
	 * Binds layout components to the container.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return void
	 */
	public function register() {
		$this->app->singleton( Layouts::class );

		$this->app->singleton( Component::class, function() {
			return new Component(
				$this->app->resolve( Layouts::class )
			);
		} );
	}

	/**
	 * Bootstrap the layout family component.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return void
	 */
	public function boot() {
		$this->app->resolve( Component::class )->boot();
	}
}
