<?php
/**
 * Image Size Service Provider.
 *
 * Bootstraps the image size component.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Image\Size;

use Hybrid\Tools\ServiceProvider;

/**
 * Image size service provider class.
 *
 * @since  1.0.0
 * @access public
 */
class Provider extends ServiceProvider {

	/**
	 * Binds image size component to the container.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {
		$this->app->singleton( Sizes::class );

		$this->app->singleton( Component::class, function() {
			return new Component( $this->app->resolve( Sizes::class ) );
		} );
	}

	/**
	 * Bootstrap the image size component.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {
		$this->app->resolve( Component::class )->boot();
	}
}
