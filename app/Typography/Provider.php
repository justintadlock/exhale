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

namespace Exhale\Typography;

use Hybrid\Tools\ServiceProvider;
use Exhale\Tools\CustomProperties;

use Exhale\Typography\Font\Family;
use Exhale\Typography\Font\Style;
//use Exhale\Typography\Font\VariantCaps;
use Exhale\Typography\Setting;
//use Exhale\Typography\Text\Transform;

/**
 * Font service provider class.
 *
 * @since  2.0.0
 * @access public
 */
class Provider extends ServiceProvider {

	/**
	 * Binds font components to the container.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		// Font family component.
		$this->app->singleton( Family\Families::class );

		$this->app->singleton( Family\Component::class, function() {
			return new Family\Component(
				$this->app->resolve( Family\Families::class  )
			);
		} );

		// Settings component.
		$this->app->singleton( Setting\Settings::class );

		$this->app->singleton( Setting\Component::class, function() {
			return new Setting\Component(
				$this->app->resolve( Setting\Settings::class ),
				$this->app->resolve( CustomProperties::class ),
				[
					'families'   => $this->app->resolve( Family\Families::class )
				]
			);
		} );

		$this->app->singleton( Customize::class, function() {
			return new Customize( [
				'settings'   => $this->app->resolve( Setting\Settings::class     ),
				'families'   => $this->app->resolve( Family\Families::class      ),
			] );
		} );

		$this->app->alias( Family\Families::class,      'font/families'       );
	}

	/**
	 * Bootstrap the font family component.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {
		$this->app->resolve( Family\Component::class      )->boot();
		$this->app->resolve( Setting\Component::class     )->boot();
	}
}
