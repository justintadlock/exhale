<?php
/**
 * Query component.
 *
 * Handles filters on the posts query.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\CleanWP;

use WP_Query;
use Hybrid\Contracts\Bootable;
use Exhale\Settings\Options;

/**
 * Query component class.
 *
 * @since  1.0.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Bootstraps the class' actions/filters.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		if ( Options::get( 'disable_emoji' ) ) {
			remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		}

		if ( Options::get( 'disable_toolbar' ) ) {
			add_filter( 'show_admin_bar', '__return_false' );
		}

		// WP adds this on `wp_head` with a priority of `10`, which runs
		// after scripts have been enqueued, so it goes to the footer.
		if ( Options::get( 'disable_wp_embed' ) ) {
			add_action( 'wp_footer', [ $this, 'dequeueEmbed' ] );
		}
	}

	public function dequeueEmbed() {

		wp_dequeue_script( 'wp-embed' );
	}
}
