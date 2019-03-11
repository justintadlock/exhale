<?php

namespace Exhale\Color;

use Hybrid\Tools\ServiceProvider;

class Provider extends ServiceProvider {

	public function register() {
		$this->app->singleton( Settings::class );

		$this->app->singleton( Component::class, function() {
			return new Component(
				$this->app->resolve( Settings::class )
			);
		} );
	}

	public function boot() {
		$this->app->resolve( Component::class )->boot();
	}
}
