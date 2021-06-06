<?php
/**
 * Template hierarchy class.
 *
 * The framework has its own template hierarchy that can be used instead of the
 * default WordPress template hierarchy.  It is not much different than the
 * default.  It was built to extend the default by making it smarter and more
 * flexible.  The goal is to give theme developers and end users an easy-to-override
 * system that doesn't involve massive amounts of conditional tags within files.
 *
 * @package   HybridCore
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008 - 2019, Justin Tadlock
 * @link      https://themehybrid.com/hybrid-core
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Exhale\Template;

use WP_User;

/**
 * Overwrites the core WP template hierarchy.
 *
 * @since  3.0.0
 * @access public
 */
class Hierarchy {

	/**
	 * Sets up template hierarchy filters.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		// Filter the front page template.
		add_filter( 'frontpage_template_hierarchy',  [ $this, 'frontPage' ], 5 );

		// Filter the single, page, and attachment templates.
		add_filter( 'single_template_hierarchy',     [ $this, 'single' ], 5 );
		add_filter( 'page_template_hierarchy',       [ $this, 'single' ], 5 );
		add_filter( 'attachment_template_hierarchy', [ $this, 'single' ], 5 );

		// Filter taxonomy templates.
		add_filter( 'taxonomy_template_hierarchy', [ $this, 'taxonomy' ], 5 );
		add_filter( 'category_template_hierarchy', [ $this, 'taxonomy' ], 5 );
		add_filter( 'tag_template_hierarchy',      [ $this, 'taxonomy' ], 5 );

		// Filter the author template.
		add_filter( 'author_template_hierarchy', [ $this, 'author' ], 5 );

		// Filter the date template.
		add_filter( 'date_template_hierarchy', [ $this, 'date' ], 5 );
	}

	/**
	 * Fix for the front page template handling in WordPress core. Its
	 * handling is not logical because it forces devs to account for both a
	 * page on the front page and posts on the front page.  Theme devs must
	 * handle both scenarios if they've created a "front-page.html" template.
	 * This filter overwrites that and disables the `front-page.html` template
	 * if posts are to be shown on the front page.  This way, the
	 * `front-page.html` template will only ever be used if an actual page is
	 * supposed to be shown on the front.
	 *
	 * Additionally, this filter allows the user to override the front page
	 * via the standard page template.  User choice should always trump
	 * developer choice.
	 *
	 * @since  3.0.0
	 * @access public
	 * @param  array   $templates
	 * @return array
	 */
	public function frontPage( $templates ) {

		$templates = [];

		if ( ! is_home() ) {

			$custom = get_page_template_slug( get_queried_object_id() );

			if ( $custom ) {
				$templates[] = $custom;
			}

			$templates[] = 'front-page.html';
		}

		// Return the template hierarchy.
		return $templates;
	}

	/**
	 * Overrides the default single (singular post) template for all post
	 * types, including pages and attachments.
	 *
	 * @since  3.0.0
	 * @access public
	 * @param  array   $templates
	 * @return array
	 */
	public function single( $templates ) {

		$templates = [];

		// Get the queried post.
		$post = get_queried_object();

		// Decode the post name.
		$name = urldecode( $post->post_name );

		// Check for a custom post template.
		$custom = get_page_template_slug( $post->ID );

		if ( $custom ) {
			$templates[] = $custom;
		}

		// If viewing an attachment page, handle the files by mime type.
		if ( is_attachment() ) {

			// Split the mime type into two distinct parts.
			$type    = get_post_mime_type( $post );
			$subtype = '';

			if ( false !== strpos( $type, '/' ) ) {
				list( $type, $subtype ) = explode( '/', $type );
			}

			if ( $subtype ) {
				$templates[] = "attachment-{$type}-{$subtype}.html";
				$templates[] = "attachment-{$subtype}.html";
			}

			$templates[] = "attachment-{$type}.html";

		// If not viewing an attachment page.
		} else {

			// Add a post ID template.
			$templates[] = "single-{$post->post_type}-{$post->ID}.html";
			$templates[] = "{$post->post_type}-{$post->ID}.html";

			// Add a post name (slug) template.
			$templates[] = "single-{$post->post_type}-{$name}.html";
			$templates[] = "{$post->post_type}-{$name}.html";
		}

		// Add a template based off the post type name.
		$templates[] = "single-{$post->post_type}.html";
		$templates[] = "{$post->post_type}.html";

		// Allow for WP standard 'single' template.
		$templates[] = 'single.html';

		// Return the template hierarchy.
		return $templates;
	}

	/**
	 * Overrides WP's default template for taxonomy-based archives. This
	 * allows better organization of taxonomy template files by making
	 * categories and post tags work the same way as other taxonomies.
	 *
	 * @since  3.0.0
	 * @access public
	 * @param  array   $templates
	 * @return array
	 */
	public function taxonomy( $template ) {

		$templates = [];

		// Get the queried term object.
		$term = get_queried_object();
		$slug = urldecode( $term->slug );

		// Remove 'post-format' from the slug.
		if ( 'post_format' === $term->taxonomy ) {
			$slug = str_replace( 'post-format-', '', $slug );
		}

		// Slug-based template.
		$templates[] = "taxonomy-{$term->taxonomy}-{$slug}.html";

		// Taxonomy-specific template.
		$templates[] = "taxonomy-{$term->taxonomy}.html";

		// Default template.
		$templates[] = 'taxonomy.html';

		// Return the template hierarchy.
		return $templates;
	}

	/**
	 * Overrides WP's default template for author-based archives. Better
	 * abstraction of templates than `is_author()` allows by allowing themes
	 * to specify templates for a specific author.
	 *
	 * @since  3.0.0
	 * @access public
	 * @param  array   $templates
	 * @return array
	 */
	public function author( $templates ) {

		$templates = [];

		// Get the user nicename.
		$name = get_the_author_meta( 'user_nicename', get_query_var( 'author' ) );

		// Get the user object.
		$user = new WP_User( absint( get_query_var( 'author' ) ) );

		// Add the user nicename template.
		$templates[] = "user-{$name}.html";

		// Add role-based templates for the user.
		if ( is_array( $user->roles ) ) {

			foreach ( $user->roles as $role ) {
				$templates[] = "user-role-{$role}.html";
			}
		}

		// Add a basic user/author template.
		$templates[] = 'user.html';
		$templates[] = 'author.html';

		// Return the template hierarchy.
		return $templates;
	}

	/**
	 * Overrides WP's default template for date-based archives. Better
	 * abstraction of templates than `is_date()` allows by checking for the
	 * year, month, week, day, hour, and minute.
	 *
	 * @since  3.0.0
	 * @access public
	 * @param  array   $templates
	 * @return array
	 */
	public function date( $templates ) {

		$templates = [];

		// If viewing a time-based archive.
		if ( is_time() ) {

			// If viewing a minutely archive.
			if ( get_query_var( 'minute' ) ) {
				$templates[] = 'minute.html';

			// If viewing an hourly archive.
			} elseif ( get_query_var( 'hour' ) ) {
				$templates[] = 'hour.html';
			}

			// Catchall for any time-based archive.
			$templates[] = 'time.html';

		// If viewing a daily archive.
		} elseif ( is_day() ) {

			$templates[] = 'day.html';

		// If viewing a weekly archive.
		} elseif ( get_query_var( 'w' ) ) {

			$templates[] = 'week.html';

		// If viewing a monthly archive.
		} elseif ( is_month() ) {

			$templates[] = 'month.html';

		// If viewing a yearly archive.
		} elseif ( is_year() ) {

			$templates[] = 'year.html';
		}

		// Catchall template for date-based archives.
		$templates[] = 'date.html';

		// Return the template hierarchy.
		return $templates;
	}
}
