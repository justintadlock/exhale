<?php

namespace Exhale\Color;

use Hybrid\Contracts\Bootable;
use Exhale\Tools\Config;

class Component implements Bootable {

	protected $settings;

	public function __construct( Settings $settings ) {
		$this->settings = $settings;
	}

	public function boot() {

		add_action( 'after_setup_theme', [ $this, 'addThemeSupport' ] );

		add_action( 'extant/color/settings/register', [ $this, 'registerDefaultSettings'] );
	}

	public function addThemeSupport() {

		do_action( 'extant/color/settings/register', $this->settings );

		// Editor color palette.
		add_theme_support( 'editor-color-palette', $this->settings->editorPalette() );
	}

	public function registerDefaultSettings( $settings ) {

		foreach ( Config::get( 'color-settings.php' ) as $name => $options ) {
			$settings->add( $name, $options );
		}
	}

	public function inlineStyle() {

		$css = '';

		foreach ( $this->settings as $setting ) {
			$color = $setting->rgb();

			$css .= sprintf(
				'--color-%s: %s;',
				esc_html( $setting->name() ),
				esc_html( sprintf(
					'%s,%s,%s',
					$color['r'],
					$color['g'],
					$color['b']
				) )
			);
		}

		return sprintf( ':root { %s }', $css );
	}
}
