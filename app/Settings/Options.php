<?php

namespace Exhale\Settings;

class Options {

	public static function get( $name = '' ) {

		$defaults = static::defaults();
		$settings = wp_parse_args( get_option( 'exhale_settings', $defaults ), $defaults );

		if ( ! $name ) {
			return $settings;
		}

		return isset( $settings[ $name ] ) ? $settings[ $name ] : null;
	}

	public static function defaults() {

		return apply_filters( 'exhale/settings/options/defaults', [
			// 1.0.0
			'classic_style'        => false,
			'home_posts_number'    => 3,
			'archive_posts_number' => 100,
			'disable_emoji'        => true,
			'disable_toolbar'      => false,
			'disable_wp_embed'     => false,
			'error_page'           => 0
		] );
	}
}
