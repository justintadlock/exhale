<?php

namespace Exhale\Background;

use Hybrid\Tools\ServiceProvider;

/**
 * CleanWP service provider class.
 *
 * @since  1.0.0
 * @access public
 */
class Provider extends ServiceProvider {

	/**
	 * Binds query component to the container.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		$this->app->singleton( Pattern\Patterns::class );

		$this->app->singleton( Pattern\Component::class, function() {
			return new Pattern\Component( $this->app->resolve( Pattern\Patterns::class ) );
		} );

		$this->app->singleton( Customize::class, function() {
			return new Customize( [
				'patterns' => $this->app->resolve( Pattern\Patterns::class )
			] );
		} );
	}

	/**
	 * Bootstrap the query component.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {
		$this->app->resolve( Pattern\Component::class )->boot();
	}
}
