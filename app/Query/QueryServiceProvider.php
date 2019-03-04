<?php

namespace Exhale\Query;

use Hybrid\Tools\ServiceProvider;

class QueryServiceProvider extends ServiceProvider {

	public function register() {
		$this->app->singleton( Query::class );
	}

	public function boot() {
		$this->app->resolve( Query::class )->boot();
	}
}
