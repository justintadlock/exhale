<?php
/**
 * Settings Provider.
 *
 * Bootstraps the settings component.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Settings;

use Hybrid\Tools\ServiceProvider;
use Exhale\Settings\Admin\OptionsPage;
use Exhale\Settings\Admin\Views\Views;

/**
 * Settings provider class.
 *
 * @since  1.0.0
 * @access public
 */
class Provider extends ServiceProvider {

	/**
	 * Binds settings component to the container.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		$this->app->singleton( Views::class );

		$this->app->singleton( OptionsPage::class, function() {

			return new OptionsPage(
				'exhale-settings',
				$this->app->resolve( Views::class ),
				[
					'label'      => __( 'Exhale Settings', 'exhale' ),
					'capability' => 'edit_theme_options'
				]
			);
		} );
	}

	/**
	 * Bootstrap the settings component.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		if ( is_admin() ) {
			$this->app->resolve( OptionsPage::class )->boot();
		}
	}
}
