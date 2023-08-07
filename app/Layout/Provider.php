<?php
/**
 * Layout Service Provider.
 *
 * Bootstraps the layout components.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Layout;

use Hybrid\Core\ServiceProvider;

/**
 * Layout service provider class.
 *
 * @since  1.2.0
 *
 * @access public
 */
class Provider extends ServiceProvider {

    /**
     * Binds layout components to the container.
     *
     * @since  1.2.0
     * @return void
     *
     * @access public
     */
    public function register() {

        $this->app->singleton( 'layouts/global', Layouts::class );
        $this->app->singleton( 'layouts/loop', Loop\Layouts::class );

        $this->app->singleton( App\Component::class, fn() => new App\Component( $this->app->resolve( 'layouts/global' ) ) );

        $this->app->singleton( Loop\Component::class, fn() => new Loop\Component( $this->app->resolve( 'layouts/loop' ) ) );

        $this->app->singleton( Customize::class, fn() => new Customize( [
            'app_layouts'  => $this->app->resolve( 'layouts/global' ),
            'image_sizes'  => $this->app->resolve( 'image/sizes' ),
            'loop_layouts' => $this->app->resolve( 'layouts/loop' ),
        ] ) );
    }

    /**
     * Bootstrap the layout family component.
     *
     * @since  1.2.0
     * @return void
     *
     * @access public
     */
    public function boot() {
        $this->app->resolve( App\Component::class )->boot();
        $this->app->resolve( Loop\Component::class )->boot();
    }

}
