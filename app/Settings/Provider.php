<?php
/**
 * Settings Provider.
 *
 * Bootstraps the settings component.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Settings;

use Exhale\Settings\Admin\OptionsPage;
use Exhale\Settings\Admin\Views\Views;
use Hybrid\Core\ServiceProvider;

/**
 * Settings provider class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class Provider extends ServiceProvider {

    /**
     * Binds settings component to the container.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function register() {

        $this->app->singleton( Views::class );

        $this->app->singleton( OptionsPage::class, fn() => new OptionsPage(
            'exhale-settings',
            $this->app->resolve( Views::class ),
            [
                'capability' => 'edit_theme_options',
                'label'      => __( 'Exhale Settings', 'exhale' ),
            ]
        ) );
    }

    /**
     * Bootstrap the settings component.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function boot() {

        if ( is_admin() ) {
            $this->app->resolve( OptionsPage::class )->boot();
        }
    }

}
