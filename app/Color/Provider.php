<?php
/**
 * Color Service Provider.
 *
 * Bootstraps the color component.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Color;

use Exhale\Tools\CustomProperties;
use Hybrid\Core\ServiceProvider;

/**
 * Color service provider class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class Provider extends ServiceProvider {

    /**
     * Binds color component to the container.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function register() {
        $this->app->singleton( Setting\Settings::class );

        $this->app->singleton( Setting\Component::class, fn() => new Setting\Component(
            $this->app->resolve( Setting\Settings::class ),
            $this->app->resolve( CustomProperties::class )
        ) );

        $this->app->singleton( Customize::class, fn() => new Customize( [
            'settings' => $this->app->resolve( Setting\Settings::class ),
        ] ) );

        $this->app->alias( Setting\Settings::class, 'color/settings' );
    }

    /**
     * Bootstrap the color component.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function boot() {
        $this->app->resolve( Setting\Component::class )->boot();
    }

}
