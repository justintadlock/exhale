<?php
/**
 * Font Family Service ServiceProvider.
 *
 * Bootstraps the font family component.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Font\Family;

use Hybrid\Tools\ServiceProvider;

/**
 * Font family service provider class.
 *
 * @since  1.0.0
 * @access public
 */
class Provider extends ServiceProvider {

	/**
	 * Binds font family component to the container.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {
		$this->app->singleton( Settings::class );
		$this->app->singleton( Choices::class  );

		$this->app->singleton( Component::class, function() {
			return new Component(
				$this->app->resolve( Settings::class ),
				$this->app->resolve( Choices::class  )
			);
		} );
	}

	/**
	 * Bootstrap the font family component.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {
		$this->app->resolve( Component::class )->boot();
	}
}
