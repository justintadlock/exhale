<?php
/**
 * Background Service Provider.
 *
 * Bootstraps the background component.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Background;

use Hybrid\Core\ServiceProvider;

/**
 * Background service provider class.
 *
 * @since  2.2.0
 * @access public
 */
class Provider extends ServiceProvider {

	/**
	 * Binds query component to the container.
	 *
	 * @since  2.2.0
	 * @access public
	 * @return void
	 */
	public function register() {

		$this->app->singleton( Pattern\Patterns::class );

		$this->app->singleton( Component::class, function() {
			return new Component( [
				'patterns' => $this->app->resolve( Pattern\Patterns::class )
			] );
		} );

		$this->app->singleton( Customize::class, function() {
			return new Customize( [
				'patterns' => $this->app->resolve( Pattern\Patterns::class )
			] );
		} );
	}

	/**
	 * Bootstrap the component.
	 *
	 * @since  2.2.0
	 * @access public
	 * @return void
	 */
	public function boot() {
		$this->app->resolve( Component::class )->boot();
	}
}
