<?php

namespace Exhale\Query;

use Hybrid\Tools\ServiceProvider;

class Provider extends ServiceProvider {

	public function register() {
		$this->app->singleton( Component::class );
	}

	public function boot() {
		$this->app->resolve( Component::class )->boot();
	}
}
