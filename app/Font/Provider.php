<?php
/**
 * Font Service Provider.
 *
 * Bootstraps the font components.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Font;

use Hybrid\Tools\ServiceProvider;
use Exhale\Tools\CustomProperties;

/**
 * Font service provider class.
 *
 * @since  1.0.0
 * @access public
 */
class Provider extends ServiceProvider {

	/**
	 * Binds font components to the container.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {
		$this->app->singleton( Family\Families::class  );
		$this->app->singleton( Setting\Settings::class );
		$this->app->singleton( Size\Sizes::class       );
		$this->app->singleton( Style\Styles::class     );

		$this->app->singleton( Style\Component::class, function() {
			return new Style\Component(
				$this->app->resolve( Style\Styles::class )
			);
		} );

		$this->app->singleton( Family\Component::class, function() {
			return new Family\Component(
				$this->app->resolve( Family\Families::class  )
			);
		} );

		$this->app->singleton( Setting\Component::class, function() {
			return new Setting\Component(
				$this->app->resolve( Setting\Settings::class  ),
				$this->app->resolve( CustomProperties::class  ),
				$this->app->resolve( Family\Families::class   ),
				$this->app->resolve( Style\Styles::class      )
			);
		} );

		$this->app->singleton( Size\Component::class, function() {
			return new Size\Component(
				$this->app->resolve( Size\Sizes::class )
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
		$this->app->resolve( Family\Component::class  )->boot();
		$this->app->resolve( Style\Component::class   )->boot();
		$this->app->resolve( Setting\Component::class )->boot();
		$this->app->resolve( Size\Component::class    )->boot();
	}
}
