<?php
/**
 * App service provider.
 *
 * Service providers are essentially the bootstrapping code for your theme.
 * They allow you to add bindings to the container on registration and boot them
 * once everything has been registered.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale;

use Hybrid\Tools\ServiceProvider;
use Exhale\Tools\Config;
use Exhale\Tools\CustomProperties;

/**
 * App service provider.
 *
 * @since  1.0.0
 * @access public
 */
class Provider extends ServiceProvider {

	/**
	 * Callback executed when the `\Hybrid\Core\Application` class registers
	 * providers. Use this method to bind items to the container.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		// Bind a single instance of theme mod defaults.
		$this->app->singleton( 'exhale/mods', function() {

			return array_merge(
				Config::get( '_settings-mods' ),
				Config::get( 'settings-mods'  )
			);
		} );

		// Bind a single instance of the WP custom background settings.
		$this->app->singleton( 'exhale/compat/background', function() {
			return array_merge(
				Config::get( 'custom-background' ),
				[
					'default-image'          => '',
					'default-position-x'     => 'left',
					'default-position-y'     => 'top',
					'default-size'           => 'auto',
					'default-repeat'         => 'repeat',
					'default-attachment'     => 'scroll',
					'default-color'          => 'f3f3f3'
				]
			);
		} );

		// Bind the Laravel Mix manifest for cache-busting.
		$this->app->singleton( 'exhale/mix', function() {

			$file     = get_parent_theme_file_path( 'public/mix-manifest.json' );
			$contents = (array) json_decode( file_get_contents( $file ), true );

			if ( is_child_theme() ) {
				$child = get_stylesheet_directory() . '/public/mix-manifest.json';

				if ( file_exists( $child ) ) {
					$contents = array_merge(
						$contents,
						(array) json_decode( file_get_contents( $file ), true )
					);
				}
			}

			return $contents;
		} );

		// Bind a single instance of the custom properties class.
		$this->app->singleton( CustomProperties::class );
	}
}
