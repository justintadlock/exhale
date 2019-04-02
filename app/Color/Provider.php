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
use Exhale\Tools\CustomProperties;

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
		$this->app->singleton( Customize\Colors::class );
		$this->app->singleton( Editor\Colors::class    );

		$this->app->singleton( Customize\Component::class, function() {
			return new Customize\Component(
				$this->app->resolve( Customize\Colors::class ),
				$this->app->resolve( CustomProperties::class )
			);
		} );

		$this->app->singleton( Editor\Component::class, function() {
			return new Editor\Component(
				$this->app->resolve( Editor\Colors::class    ),
				$this->app->resolve( CustomProperties::class )
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
		$this->app->resolve( Customize\Component::class )->boot();
		$this->app->resolve( Editor\Component::class    )->boot();
	}
}
