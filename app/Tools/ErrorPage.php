<?php

namespace Exhale\Tools;

use Exhale\Settings\Options;

use function Hybrid\Post\render_title;

class ErrorPage {

	protected $post = null;

	public function __construct() {

		$page_id = absint( Options::get( 'error_page' ) );

		if ( $page_id ) {
			$this->post = get_post( $page_id );
		}
	}

	public function hasPost() {
		return $this->post && ! is_wp_error( $this->post );
	}

	public function setup() {

		if ( $this->hasPost() ) {
			$GLOBALS['post'] = $this->post;

			setup_postdata( $this->post );
		}

		return $this;
	}

	public function reset() {

		if ( $this->hasPost() ) {
			wp_reset_postdata();
		}
	}

	public function displayTitle() {

		if ( $this->hasPost() ) {
			add_filter( 'private_title_format', [ $this, 'removePrivateTitleFormat' ] );
			the_title();
			remove_filter( 'private_title_format', [ $this, 'removePrivateTitleFormat' ] );
			return;
		}

		esc_html_e( 'Whoah, partner!' );
	}

	public function removePrivateTitleFormat() {
		return '%s';
	}

	public function displayContent() {

		if ( $this->hasPost() ) {
			the_content();
			return;
		}

		printf(
			'<p>%s</p>',
			esc_html__( 'It looks like you stumbled upon a page that does not exist. Perhaps rolling the dice with a search might help.' )
		);

		get_search_form();
	}
}
