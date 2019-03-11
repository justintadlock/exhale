<?php

namespace Exhale\Tools;

class Config {

	public static function get( $file ) {

		return include( static::path( $file ) );
	}

	public static function path( $file = '' ) {

		$file = trim( $file, '/' );

		return get_parent_theme_file_path( $file ? "config/{$file}" : 'config' );
	}
}
