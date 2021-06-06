<?php
/**
 * Template hierarchy service provider.
 *
 * This is the service provider for the template hierarchy. It's used to register
 * the template hierarchy with the container and boot it when needed.
 *
 * @package   HybridCore
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008 - 2019, Justin Tadlock
 * @link      https://themehybrid.com/hybrid-core
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Exhale\Template;

use Hybrid\Tools\ServiceProvider;

/**
 * Template hierarchy provider class.
 *
 * @since  3.0.0
 * @access public
 */
class Provider extends ServiceProvider {

	/**
	 * Registration callback that adds a single instance of the template
	 * hierarchy to the container.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function register() {
		$this->app->singleton( Hierarchy::class );
	}

	/**
	 * Boots the hierarchy by firing its hooks in the `boot()` method.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {
		$this->app->resolve( Hierarchy::class )->boot();
	}
}
