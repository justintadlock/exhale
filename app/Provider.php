<?php
/**
 * App service provider.
 *
 * Service providers are essentially the bootstrapping code for your theme.
 * They allow you to add bindings to the container on registration and boot them
 * once everything has been registered.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale;

use Hybrid\Tools\ServiceProvider;

/**
 * App service provider.
 *
 * @since  1.0.0
 * @access public
 */
class Provider extends ServiceProvider {

	/**
	 * Callback executed when the `\Hybrid\Core\Application` class registers
	 * providers. Use this method to bind items to the container.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		// Bind primary theme components.
		$this->app->singleton( Setup::class );
		$this->app->singleton( Assets::class );

		// Bind block components.
		$this->app->singleton( Block\Patterns\Component::class  );
		$this->app->singleton( Block\Plugins\Component::class   );
		$this->app->singleton( Block\Styles\Component::class    );
		$this->app->singleton( Block\Supports\Component::class  );
		$this->app->singleton( Block\Templates\Component::class );

		// bind image components.
		$this->app->singleton( Image\Size\Sizes::class   );

		$this->app->singleton( Image\Size\Component::class, function() {
			return new Image\Size\Component(
				$this->app->resolve( Image\Size\Sizes::class )
			);
		} );

		// Bind template components.
		$this->app->singleton( Template\Hierarchy::class );
	}

	/**
	 * Bootstrap bindings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		// Boot primary theme components.
		$this->app->resolve( Setup::class )->boot();
		$this->app->resolve( Assets::class )->boot();

		// Boot block components.
		$this->app->resolve( Block\Patterns\Component::class  )->boot();
		$this->app->resolve( Block\Plugins\Component::class   )->boot();
		$this->app->resolve( Block\Styles\Component::class    )->boot();
		$this->app->resolve( Block\Supports\Component::class  )->boot();
		$this->app->resolve( Block\Templates\Component::class )->boot();

		// Boot image components.
		$this->app->resolve( Image\Size\Component::class )->boot();

		// Boot template components.
		$this->app->resolve( Template\Hierarchy::class )->boot();
	}
}
