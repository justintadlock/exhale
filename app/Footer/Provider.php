<?php
/**
 * Footer service provider.
 *
 * Bootstraps the Footer component.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Footer;

use Hybrid\Core\ServiceProvider;

/**
 * Footer service provider class.
 *
 * @since  2.1.0
 *
 * @access public
 */
class Provider extends ServiceProvider {

    /**
     * Binds components to the container.
     *
     * @since  2.1.0
     * @return void
     *
     * @access public
     */
    public function register() {
        $this->app->singleton( Customize::class );
    }

}
