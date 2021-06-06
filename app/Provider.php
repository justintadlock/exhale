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

		$this->app->singleton( Setup::class );
		$this->app->singleton( Assets::class );

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
	}

	/**
	 * Bootstrap bindings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {
		$this->app->resolve( Setup::class )->boot();
		$this->app->resolve( Assets::class )->boot();
	}
}
