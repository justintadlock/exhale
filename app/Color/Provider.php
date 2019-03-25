<?php
/**
 * Color Service Provider.
 *
 * Bootstraps the color component.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Color;

use Hybrid\Tools\ServiceProvider;

/**
 * Color service provider class.
 *
 * @since  1.0.0
 * @access public
 */
class Provider extends ServiceProvider {

	/**
	 * Binds color component to the container.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {
		$this->app->singleton( CustomizeColors::class );
		$this->app->singleton( EditorColors::class    );

		$this->app->singleton( Component::class, function() {
			return new Component(
				$this->app->resolve( CustomizeColors::class ),
				$this->app->resolve( EditorColors::class    )
			);
		} );
	}

	/**
	 * Bootstrap the color component.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {
		$this->app->resolve( Component::class )->boot();
	}
}
