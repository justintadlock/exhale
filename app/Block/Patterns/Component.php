<?php
/**
 * Block component.
 *
 * Handles the block feature.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Block\Patterns;

use Hybrid\Contracts\Bootable;
use WP_Block_Pattern_Categories_Registry as CategoriesRegistry;

/**
 * Block component class.
 *
 * @since  2.2.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Bootstraps the class' actions/filters.
	 *
	 * @since  2.2.0
	 * @access public
	 * @return void
	 */
	public function boot() {
		add_action( 'init', [ $this, 'registerPatterns' ], 15 );
	}

	protected function locate( $slug ) {
		ob_start();
		include get_theme_file_path( "lib/block-patterns/{$slug}.php" );
		return ob_get_clean();
	}

	protected function registerPattern( $slug, array $args ) {

		$args = wp_parse_args( $args, [
			'categories'    => [],
			'content'       => str_replace( [ "\n", "\r", "\t" ], '', $this->locate( $slug ) ),
			'viewportWidth' => 1520
		] );

		if ( empty( $args['categories'] ) ) {
			$args['categories'][] = 'exhale';
		}

		return register_block_pattern( "exhale/{$slug}", $args );
	}

	public function registerPatterns() {

		$categories_registry = CategoriesRegistry::get_instance();

		$width_content   = 624;
		$width_alignwide = 1024;

		// Pattern categories.

		$categories = [
			'book'        => __( 'Book' ),
			'cover'       => __( 'Covers' ),
			'exhale'      => __( 'Exhale' ),
			'forms'       => __( 'Forms' ),
			'magazine'    => __( 'Magazine' ),
			'portfolio'   => __( 'Portfolio' ),
			'post-header' => __( 'Post Header' ),
			'profile'     => __( 'Profile / Bio' ),
			'query'       => __( 'Query' ),
			'quote'       => __( 'Quotes' ),
			'recipe'      => __( 'Recipe' ),
			'team'        => __( 'Team' )
		];

		foreach ( $categories as $name => $label ) {
			if ( ! $categories_registry->is_registered( $name ) ) {
				register_block_pattern_category( $name, [
					'label' => $label
				] );
			}
		}

		// Patterns.

		$this->registerPattern( 'audio-cover', [
			'title' => __( 'Audio: Cover' ),
			'categories' => [ 'cover' ],
			'viewportWidth' => $width_alignwide
		] );

		$this->registerPattern( 'audio-cover-dj', [
			'title' => __( 'Audio: Cover DJ' ),
			'categories' => [ 'cover' ]
		] );

		$this->registerPattern( 'author-intro', [
			'title' => __( 'Author Intro' ),
			'categories' => [ 'book', 'cover' ]
		] );

		$this->registerPattern( 'book-card', [
			'title' => __( 'Book Card' ),
			'categories' => [ 'book' ],
			'viewportWidth' => $width_alignwide
		] );

		$this->registerPattern( 'book-card-emoji', [
			'title' => __( 'Book Card (Emoji)' ),
			'categories' => [ 'book' ],
			'viewportWidth' => $width_alignwide
		] );

		$this->registerPattern( 'book-card-intro', [
			'title' => __( 'Book Card Intro' ),
			'categories' => [ 'book' ],
			'viewportWidth' => $width_alignwide
		] );

		$this->registerPattern( 'columns-connect-boxes', [
			'title' => __( 'Columns: Connect Boxes' ),
			'categories' => [ 'columns', 'profile' ]
		] );

		$this->registerPattern( 'columns-cards', [
			'title' => __( 'Columns: Cards' ),
			'categories' => [ 'columns' ]
		] );

		$this->registerPattern( 'columns-cards-horizontal', [
			'title' => __( 'Columns: Cards Horizontal' ),
			'categories' => [ 'columns' ]
		] );

		$this->registerPattern( 'columns-movie-posters', [
			'title' => __( 'Columns: Movie Posters' ),
			'categories' => [ 'columns' ]
		] );

		$this->registerPattern( 'columns-square-image-text-boxes', [
			'title' => __( 'Columns: Square Image Text Boxes' ),
			'categories' => [ 'columns' ]
		] );

		$this->registerPattern( 'columns-team-portraits', [
			'title' => __( 'Columns: Team Portraits' ),
			'categories' => [ 'columns', 'team' ]
		] );

		$this->registerPattern( 'cover-inner-border', [
			'title' => __( 'Cover: Inner Border' ),
			'categories' => [ 'cover' ]
		] );

		$this->registerPattern( 'cover-quote', [
			'title' => __( 'Cover: Quote' ),
			'categories' => [ 'cover', 'quote' ]
		] );

		$this->registerPattern( 'cover-search', [
			'title' => __( 'Cover: Search' ),
			'categories' => [ 'cover', 'forms' ]
		] );

		$this->registerPattern( 'cover-splash-social', [
			'title' => __( 'Cover: Splash Social' ),
			'categories' => [ 'cover' ]
		] );

		$this->registerPattern( 'gallery-text-grid', [
			'title' => __( 'Gallery: Text Grid' ),
			'viewportWidth' => $width_alignwide + 64,
			'categories' => [ 'gallery' ]
		] );

		$this->registerPattern( 'hero-adventure', [
			'title' => __( 'Hero: Adventure' ),
			'categories' => [ 'cover' ]
		] );

		$this->registerPattern( 'hero-camping', [
			'title' => __( 'Hero: Camping' ),
			'categories' => [ 'cover' ]
		] );

		$this->registerPattern( 'hero-header-with-data', [
			'title' => __( 'Hero: Header with Data' ),
			'categories' => [ 'cover' ]
		] );

		$this->registerPattern( 'hero-intro-portfolio', [
			'title' => __( 'Hero: Intro Portfolio' ),
			'categories' => [ 'cover' ]
		] );

		$this->registerPattern( 'hero-search', [
			'title' => __( 'Hero: Search' ),
			'categories' => [ 'forms' ]
		] );

		$this->registerPattern( 'hero-video-space', [
			'title' => __( 'Hero: Video Space' ),
			'categories' => [ 'cover' ]
		] );

		$this->registerPattern( 'media-text-post-header', [
			'title' => __( 'Media & Text: Post Header' )
		] );

		$this->registerPattern( 'portfolio-photographer-intro', [
			'title' => __( 'Portfolio: Photographer Intro' )
		] );

		$this->registerPattern( 'portfolio-single-project-gallery', [
			'title' => __( 'Portfolio: Single Project Gallery' )
		] );

		$this->registerPattern( 'portfolio-single-project-wide', [
			'title' => __( 'Portfolio: Single Project Wide' )
		] );

		$this->registerPattern( 'post-header-long-read', [
			'title' => __( 'Post Header: Long Read' )
		] );

		$this->registerPattern( 'pricing-three-columns', [
			'title' => __( 'Pricing: 3 Columns' ),
			'categories' => [ 'columns' ],
			'viewportWidth' => $width_alignwide
		] );

		$this->registerPattern( 'query-cards', [
			'title' => __( 'Query: Cards' ),
			'categories' => [ 'query' ],
			'blockTypes' => [ 'core/query' ]
		] );

		$this->registerPattern( 'quote-cover-testimonial', [
			'title' => __( 'Quote: Cover Testimonial' ),
			'viewportWidth' => $width_alignwide + 64
		] );

		$this->registerPattern( 'recipe-card-hero', [
			'title' => __( 'Recipe Card: Hero' ),
			'categories' => [ 'recipe' ],
			'viewportWidth' => $width_content
		] );

		$this->registerPattern( 'recipe-card-hero-alt', [
			'title' => __( 'Recipe Card: Hero Alt' ),
			'categories' => [ 'recipe' ],
			'viewportWidth' => $width_content
		] );

		$this->registerPattern( 'recipe-card-circle', [
			'title' => __( 'Recipe Card: Circle' ),
			'categories' => [ 'recipe' ],
			'viewportWidth' => $width_content
		] );

		$this->registerPattern( 'recipe-card-cover', [
			'title' => __( 'Recipe Card: Cover' ),
			'categories' => [ 'recipe' ],
			'viewportWidth' => $width_content
		] );

		$this->registerPattern( 'recipe-card-cursive-mono', [
			'title' => __( 'Recipe Card: Cursive Monospace' ),
			'categories' => [ 'recipe' ],
			'viewportWidth' => $width_content
		] );

		$this->registerPattern( 'recipe-card-split', [
			'title' => __( 'Recipe Card: Split' ),
			'categories' => [ 'recipe' ],
			'viewportWidth' => $width_alignwide
		] );

		$this->registerPattern( 'shop-columns-category-covers', [
			'title' => __( 'Shop: Columns Category Covers' ),
			'categories' => [ 'columns' ]
		] );

		$this->registerPattern( 'shop-hero-just-arrived', [
			'title' => __( 'Shop: Hero - Just Arrived' ),
			'categories' => [ 'cover' ]
		] );

		$this->registerPattern( 'shop-hero-video', [
			'title' => __( 'Shop: Hero Video' ),
			'categories' => [ 'cover' ]
		] );

		$this->registerPattern( 'shop-trending-boxes', [
			'title' => __( 'Shop: Trending Boxes' )
		] );

		$this->registerPattern( 'team-cards-bio-avatar', [
			'title' => __( 'Team: Cards Bio Avatar' ),
			'categories' => [ 'columns' ],
			'viewportWidth' => $width_alignwide + 64
		] );

		$this->registerPattern( 'team-cards-bio-wide', [
			'title' => __( 'Team: Cards Bio Wide' ),
			'categories' => [ 'columns' ],
			'viewportWidth' => $width_alignwide + 64
		] );

		$this->registerPattern( 'team-cards-simple', [
			'title' => __( 'Team: Cards Simple' ),
			'categories' => [ 'columns' ],
			'viewportWidth' => $width_alignwide + 64
		] );

		$this->registerPattern( 'template-story-retro', [
			'title' => __( 'Template: Story - Retro' ),
			'categories' => [ 'magazine' ]
		] );
	}










}
