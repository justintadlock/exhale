<?php

namespace Exhale\Settings;

use Hybrid\Tools\ServiceProvider;
use Exhale\Settings\Admin\OptionsPage;
use Exhale\Settings\Admin\Views\Views;

class Provider extends ServiceProvider {

	public function register() {

		$this->app->singleton( Views::class );

		$this->app->singleton( OptionsPage::class, function() {

			return new OptionsPage(
				'exhale-settings',
				$this->app->resolve( Views::class ),
				[
					'label'      => __( 'Exhale Settings' ),
					'capability' => 'manage_options'
				]
			);
		} );
	}

	public function boot() {

		if ( is_admin() ) {
			$this->app->resolve( OptionsPage::class )->boot();
		}
	}
}
