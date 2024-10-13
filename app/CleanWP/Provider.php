<?php
/**
 * CleanWP service provider.
 *
 * Bootstraps the Clean WP component.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\CleanWP;

use Hybrid\Core\ServiceProvider;

/**
 * CleanWP service provider class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class Provider extends ServiceProvider {

    /**
     * Binds query component to the container.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function register() {
        $this->app->singleton( Component::class );
    }

    /**
     * Bootstrap the query component.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function boot() {
        $this->app->resolve( Component::class )->boot();
    }

}
