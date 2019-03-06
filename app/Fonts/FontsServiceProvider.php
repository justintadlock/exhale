<?php

namespace Exhale\Fonts;

use Hybrid\Tools\ServiceProvider;

class FontsServiceProvider extends ServiceProvider {

	public function register() {
		$this->app->singleton( Families::class );

		$this->app->singleton( Manager::class, function() {
			return new Manager( $this->app->resolve( Families::class ) );
		} );
	}

	public function boot() {
		$this->app->resolve( Manager::class )->boot();
	}
}
