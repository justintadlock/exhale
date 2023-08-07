<?php
/**
 * Font Service Provider.
 *
 * Bootstraps the font components.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Editor;

use Exhale\Tools\CustomProperties;
use Hybrid\Core\ServiceProvider;

/**
 * Font service provider class.
 *
 * @since  2.0.0
 *
 * @access public
 */
class Provider extends ServiceProvider {

    /**
     * Binds font components to the container.
     *
     * @since  2.0.0
     * @return void
     *
     * @access public
     */
    public function register() {

        // Editor colors.
        $this->app->singleton( Color\Colors::class );

        $this->app->singleton( Color\Component::class, fn() => new Color\Component(
            $this->app->resolve( Color\Colors::class ),
            $this->app->resolve( CustomProperties::class )
        ) );

        // Editor fonts.
        $this->app->singleton( Font\Size\Sizes::class );

        $this->app->singleton( Font\Size\Component::class, fn() => new Font\Size\Component(
            $this->app->resolve( Font\Size\Sizes::class )
        ) );
    }

    /**
     * Bootstrap the font family component.
     *
     * @since  2.0.0
     * @return void
     *
     * @access public
     */
    public function boot() {
        $this->app->resolve( Color\Component::class )->boot();
        $this->app->resolve( Font\Size\Component::class )->boot();
    }

}
