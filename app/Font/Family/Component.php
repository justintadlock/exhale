<?php

namespace Exhale\Font\Family;

use Hybrid\Contracts\Bootable;
use Exhale\Tools\Config;

class Component implements Bootable {

	protected $settings;

	protected $choices;

	public function __construct( Settings $settings, Choices $choices ) {

		$this->settings = $settings;
		$this->choices  = $choices;
	}

	public function boot() {

		add_action( 'init', [ $this, 'addThemeSupport' ] );

		add_action( 'extant/font/family/settings/register', [ $this, 'registerDefaultSettings'] );
		add_action( 'extant/font/family/choices/register',  [ $this, 'registerDefaultChoices']  );
	}

	public function addThemeSupport() {

		do_action( 'extant/font/family/settings/register', $this->settings );
		do_action( 'extant/font/family/choices/register', $this->choices   );
	}

	public function registerDefaultSettings( $settings ) {

		foreach ( Config::get( 'font-family-settings.php' ) as $name => $options ) {
			$settings->add( $name, $options );
		}
	}

	public function registerDefaultChoices( $choices ) {

		foreach ( Config::get( 'font-family-choices.php' ) as $name => $options ) {
			$choices->add( $name, $options );
		}
	}

	public function inlineStyle() {

		$css = '';

		foreach ( $this->settings as $setting ) {

			$css .= sprintf(
				'--font-family-%s: %s;',
				esc_html( $setting->name() ),
				esc_html( $this->choices->get( $setting->mod() )->stack() )
			);
		}

		return sprintf( ':root { %s }', $css );
	}
}
