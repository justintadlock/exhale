<?php
/**
 * Image Service Provider.
 *
 * Bootstraps the image component.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Image;

use Exhale\Tools\CustomProperties;
use Hybrid\Core\ServiceProvider;

/**
 * Image service provider class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class Provider extends ServiceProvider {

    /**
     * Binds image component to the container.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function register() {
        $this->app->singleton( Filter\Filters::class );
        $this->app->singleton( Size\Sizes::class );

        $this->app->singleton( Filter\Component::class, fn() => new Filter\Component(
            $this->app->resolve( Filter\Filters::class ),
            $this->app->resolve( CustomProperties::class )
        ) );

        $this->app->singleton( Size\Component::class, fn() => new Size\Component(
            $this->app->resolve( Size\Sizes::class )
        ) );

        $this->app->singleton( Customize::class, fn() => new Customize( [
            'filters' => $this->app->resolve( Filter\Filters::class ),
        ] ) );

        $this->app->alias( Filter\Filters::class, 'image/filters' );
        $this->app->alias( Size\Sizes::class, 'image/sizes' );
    }

    /**
     * Bootstrap the image size component.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function boot() {
        $this->app->resolve( Filter\Component::class )->boot();
        $this->app->resolve( Size\Component::class )->boot();
    }

}
