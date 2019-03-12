<?php

namespace Exhale\Image\Size;

use Hybrid\Tools\ServiceProvider;

class Provider extends ServiceProvider {

	public function register() {
		$this->app->singleton( Sizes::class );

		$this->app->singleton( Component::class, function() {
			return new Component( $this->app->resolve( Sizes::class ) );
		} );
	}

	public function boot() {
		$this->app->resolve( Component::class )->boot();
	}
}
