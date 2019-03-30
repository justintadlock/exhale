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

namespace Exhale\Image;

use Hybrid\Tools\ServiceProvider;
use Exhale\Image\Filter\Filters;
use Exhale\Image\Size\Sizes;

use Exhale\Image\Filter\Component as FilterComponent;
use Exhale\Image\Size\Component as SizeComponent;

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
		$this->app->singleton( Filters::class );
		$this->app->singleton( Sizes::class   );

		$this->app->singleton( FilterComponent::class, function() {
			return new FilterComponent( $this->app->resolve( Filters::class ) );
		} );

		$this->app->singleton( SizeComponent::class, function() {
			return new SizeComponent( $this->app->resolve( Sizes::class ) );
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
		$this->app->resolve( FilterComponent::class )->boot();
		$this->app->resolve( SizeComponent::class   )->boot();
	}
}
