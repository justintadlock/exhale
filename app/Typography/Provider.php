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
use Exhale\Typography\Font\VariantCaps;
use Exhale\Typography\Setting;
use Exhale\Typography\Text\Transform;

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

		// Font style component.
		$this->app->singleton( Style\Styles::class );

		$this->app->singleton( Style\Component::class, function() {
			return new Style\Component(
				$this->app->resolve( Style\Styles::class )
			);
		} );

		// Font variant caps component.
		$this->app->singleton( VariantCaps\Caps::class );

		$this->app->singleton( VariantCaps\Component::class, function() {
			return new VariantCaps\Component(
				$this->app->resolve( VariantCaps\Caps::class )
			);
		} );

		// Text transform component.
		$this->app->singleton( Transform\Transforms::class );

		$this->app->singleton( Transform\Component::class, function() {
			return new Transform\Component(
				$this->app->resolve( Transform\Transforms::class )
			);
		} );

		// Settings component.
		$this->app->singleton( Setting\Settings::class );

		$this->app->singleton( Setting\Component::class, function() {
			return new Setting\Component(
				$this->app->resolve( Setting\Settings::class ),
				$this->app->resolve( CustomProperties::class ),
				[
					'families'   => $this->app->resolve( Family\Families::class      ),
					'styles'     => $this->app->resolve( Style\Styles::class         ),
					'caps'       => $this->app->resolve( VariantCaps\Caps::class     ),
					'transforms' => $this->app->resolve( Transform\Transforms::class )
				]
			);
		} );

		$this->app->singleton( Customize::class, function() {
			return new Customize( [
				'settings'   => $this->app->resolve( Setting\Settings::class     ),
				'families'   => $this->app->resolve( Family\Families::class      ),
				'styles'     => $this->app->resolve( Style\Styles::class         ),
				'caps'       => $this->app->resolve( VariantCaps\Caps::class     ),
				'transforms' => $this->app->resolve( Transform\Transforms::class )
			] );
		} );

		$this->app->alias( Family\Families::class,      'font/families'       );
		$this->app->alias( Style\Styles::class,         'font/styles'         );
		$this->app->alias( VariantCaps\Caps::class,     'font/variant/caps'   );
		$this->app->alias( Transform\Transforms::class, 'text/transforms'     );
		$this->app->alias( Setting\Settings::class,     'typography/settings' );
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
		$this->app->resolve( Style\Component::class       )->boot();
		$this->app->resolve( VariantCaps\Component::class )->boot();
		$this->app->resolve( Transform\Component::class   )->boot();
		$this->app->resolve( Setting\Component::class     )->boot();
	}
}
