<?php
/**
 * Block Service Provider.
 *
 * Bootstraps the block component.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Block;

use Hybrid\Tools\ServiceProvider;

/**
 * Block service provider class.
 *
 * @since  1.0.0
 * @access public
 */
class Provider extends ServiceProvider {

	/**
	 * Binds block component to the container.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {
		$this->app->singleton( Patterns\Component::class );
		$this->app->singleton( Styles\Component::class );
	}

	/**
	 * Bootstrap the block component.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {
		$this->app->resolve( Patterns\Component::class )->boot();
		$this->app->resolve( Styles\Component::class )->boot();
	}
}
