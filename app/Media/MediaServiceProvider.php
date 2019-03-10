<?php

namespace Exhale\Media;

use Hybrid\Tools\ServiceProvider;

class MediaServiceProvider extends ServiceProvider {

	public function register() {
		$this->app->singleton( ImageSizes::class );

		$this->app->singleton( Component::class, function() {
			return new Component( $this->app->resolve( ImageSizes::class ) );
		} );
	}

	public function boot() {
		$this->app->resolve( Component::class )->boot();
	}
}
