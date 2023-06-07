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

use Hybrid\Core\ServiceProvider;
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

		$this->app->singleton( 'layouts/global', Layouts::class      );
		$this->app->singleton( 'layouts/loop',   Loop\Layouts::class );

		$this->app->singleton( App\Component::class, function() {
			return new App\Component( $this->app->resolve( 'layouts/global' ) );
		} );

		$this->app->singleton( Loop\Component::class, function() {
			return new Loop\Component( $this->app->resolve( 'layouts/loop' ) );
		} );

		$this->app->singleton( Customize::class, function() {
			return new Customize( [
				'app_layouts'  => $this->app->resolve( 'layouts/global' ),
				'loop_layouts' => $this->app->resolve( 'layouts/loop'   ),
				'image_sizes'  => $this->app->resolve( 'image/sizes'    )
			] );
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
		$this->app->resolve( App\Component::class )->boot();
		$this->app->resolve( Loop\Component::class )->boot();
	}
}
