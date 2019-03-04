<?php

namespace Exhale\Query;

use WP_Query;
use Hybrid\Contracts\Bootable;

class Query implements Bootable {

	/**
	 * Bootstraps the class' actions/filters.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		add_action( 'pre_get_posts', [ $this, 'preGetPosts' ] );
	}

	/**
	 * Sets the posts-per-page to 100 on archive pages.  This theme outputs
	 * a list of posts instead of the "normal" archive view.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  \WP_Query  $query
	 * @return void
	 */
	public function preGetPosts( WP_Query $query ) {

		if ( $query->is_main_query() && $query->is_archive() ) {

			$query->set(
				'posts_per_page',
				apply_filters( 'exhale/query/posts/number', 100, $query )
			);
		}
	}
}
