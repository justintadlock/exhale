<?php
/**
 * Customize service provider.
 *
 * Bootstraps the customize component.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Customize;

use Exhale\Background;
use Exhale\Color;
use Exhale\Footer;
use Exhale\Image;
use Exhale\Layout;
use Exhale\Typography;
use Hybrid\Core\ServiceProvider;

/**
 * Customize service provider.
 *
 * @since  1.0.0
 *
 * @access public
 */
class Provider extends ServiceProvider {

    /**
     * Binds customize component to the container.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function register() {

        $this->app->singleton( Component::class, static fn() => new Component( [
            Background\Customize::class,
            Color\Customize::class,
            Image\Customize::class,
            Layout\Customize::class,
            Footer\Customize::class,
            Typography\Customize::class,
        ] ) );
    }

    /**
     * Bootstrap the customize component.
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
