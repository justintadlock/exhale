<?php
/**
 * Error Page Class.
 *
 * Handles outputting the title and content for the 404 Not Found error page.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Template;

use Exhale\Settings\Options;

/**
 * Error page class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class ErrorPage {

    /**
     * The post object for the page selected as the error page.
     *
     * @since  1.0.0
     * @var    \WP_Post|null
     *
     * @access protected
     */
    protected $post = null;

    /**
     * Creates a new error page object.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
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
     * @return bool
     *
     * @access public
     */
    public function hasPost() {
        return $this->post && ! is_wp_error( $this->post );
    }

    /**
     * Runs `setup_postdata()` b/c we're running this outside of The Loop
     * and need to have a global `$post` object.
     *
     * @since  1.0.0
     * @return self
     *
     * @access public
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
     * @return void
     *
     * @access public
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
     * @return void
     *
     * @access public
     */
    public function displayTitle() {

        $format = static fn() => '%s';

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
     * @return void
     *
     * @access public
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
