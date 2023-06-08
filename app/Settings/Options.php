<?php
/**
 * Options Helper.
 *
 * This is an options helper class for quickly getting theme options.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Settings;

/**
 * Options class.
 *
 * @since  1.0.0
 * @access public
 */
class Options {

	/**
	 * Gets a theme option by name. If name is omitted, returns all options.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string  $name
	 * @return mixed
	 */
	public static function get( $name = '' ) {

		$defaults = static::defaults();
		$settings = wp_parse_args( get_option( 'exhale_settings', $defaults ), $defaults );

		if ( ! $name ) {
			return $settings;
		}

		return isset( $settings[ $name ] ) ? $settings[ $name ] : null;
	}

	/**
	 * Returns an array of all default options.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public static function defaults() {

		return apply_filters( 'exhale/settings/options/defaults', [
			// 1.0.0
			'classic_style'        => false,
			'home_posts_number'    => 10,    // @deprecated 2.1.0
			'archive_posts_number' => 10,    // @deprecated 2.1.0
			'disable_emoji'        => true,
			'disable_toolbar'      => false,
			'disable_wp_embed'     => false,
			'error_page'           => 0
		] );
	}
}
