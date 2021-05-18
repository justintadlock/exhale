<?php
/**
 * Customize service provider.
 *
 * Bootstraps the customize component.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Customize;

use Hybrid\Tools\Collection;
use Hybrid\Tools\ServiceProvider;

use Exhale\Background;
use Exhale\Color;
use Exhale\Image;
use Exhale\Layout;
use Exhale\Footer;
use Exhale\Typography;

/**
 * Customize service provider.
 *
 * @since  1.0.0
 * @access public
 */
class Provider extends ServiceProvider {

	/**
	 * Binds customize component to the container.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		$this->app->singleton( Component::class, function() {
			return new Component( [
				Typography\Customize::class
			] );
		} );
	}

	/**
	 * Bootstrap the customize component.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {
		$this->app->resolve( Component::class )->boot();
	}
}
