<?php

namespace Exhale\Colors;

use Hybrid\Tools\ServiceProvider;

class ColorsServiceProvider extends ServiceProvider {

	public function register() {
		$this->app->singleton( Colors::class );

		$this->app->singleton( Manager::class, function() {
			return new Manager( $this->app->resolve( Colors::class ) );
		} );
	}

	public function boot() {
		$this->app->resolve( Manager::class )->boot();
	}
}
