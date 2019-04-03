<?php
/**
 * Error Page Class.
 *
 * Handles outputting the title and content for the 404 Not Found error page.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Template;

use Exhale\Settings\Options;

use function Hybrid\Post\render_title;

/**
 * Error page class.
 *
 * @since  1.0.0
 * @access public
 */
class ErrorPage {

	/**
	 * The post object for the page selected as the error page.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    \WP_Post|null
	 */
	protected $post = null;

	/**
	 * Creates a new error page object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function __construct() {

		$page_id = absint( Options::get( 'error_page' ) );

		if ( $page_id ) {
			$this->post = get_post( $page_id );
		}
	}

	/**
	 * Whether a post object exists.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return bool
	 */
	public function hasPost() {
		return $this->post && ! is_wp_error( $this->post );
	}

	/**
	 * Runs `setup_postdata()` b/c we're running this outside of The Loop
	 * and need to have a global `$post` object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function setup() {

		if ( $this->hasPost() ) {
			$GLOBALS['post'] = $this->post;

			setup_postdata( $this->post );
		}

		return $this;
	}

	/**
	 * Resets the global `$post` object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function reset() {

		if ( $this->hasPost() ) {
			wp_reset_postdata();
		}
	}

	/**
	 * Displays the error page title.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function displayTitle() {

		$format = function() {
			return '%s';
		};

		if ( $this->hasPost() ) {
			add_filter( 'private_title_format', $format );
			the_title();
			remove_filter( 'private_title_format', $format );
			return;
		}

		esc_html_e( '404 Not Found', 'exhale' );
	}

	/**
	 * Displays the error page content.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function displayContent() {

		if ( $this->hasPost() ) {
			the_content();
			return;
		}

		printf(
			'<p>%s</p>',
			esc_html__( 'It looks like you stumbled upon a page that does not exist. Perhaps rolling the dice with a search might help.', 'exhale' )
		);

		get_search_form();
	}
}
