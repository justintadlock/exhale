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
use WP_Block_Type_Registry;

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
		return file_get_contents( get_theme_file_path( "lib/block-patterns/{$slug}.php" ) );
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
			'book'        => __( 'Book', 'exhale' ),
			'cover'       => __( 'Covers', 'exhale' ),
			'forms'       => __( 'Forms', 'exhale' ),
			'magazine'    => __( 'Magazine', 'exhale' ),
			'portfolio'   => __( 'Portfolio', 'exhale' ),
			'post-header' => __( 'Post Header', 'exhale' ),
			'profile'     => __( 'Profile / Bio', 'exhale' ),
			'query'       => __( 'Query', 'exhale' ),
			'quote'       => __( 'Quotes', 'exhale' ),
			'recipe'      => __( 'Recipe', 'exhale' ),
			'shop'        => __( 'Shop', 'exhale' ),
			'story'       => __( 'Story', 'exhale' ),
			'team'        => __( 'Team', 'exhale' ),
			'exhale'      => __( 'Uncategorized', 'exhale' )
		];

		foreach ( $categories as $name => $label ) {

			// Unregistering so that we can alphabetize them.
			if ( $categories_registry->is_registered( $name ) ) {
				unregister_block_pattern_category( $name );
			}

			register_block_pattern_category( $name, [
				'label' => $label
			] );
		}

		// Patterns.

		$this->registerPattern( 'audio-cover', [
			'title' => __( 'Audio: Cover', 'exhale' ),
			'categories' => [ 'cover' ],
			'viewportWidth' => $width_alignwide
		] );

		$this->registerPattern( 'audio-cover-dj', [
			'title' => __( 'Audio: Cover DJ', 'exhale' ),
			'categories' => [ 'cover' ]
		] );

		$this->registerPattern( 'author-intro', [
			'title' => __( 'Author Intro', 'exhale' ),
			'categories' => [ 'book', 'cover' ]
		] );

		$this->registerPattern( 'bio-card', [
			'title' => __( 'Bio Card' ),
			'categories' => [ 'profile' ]
		] );

		$this->registerPattern( 'bio-links', [
			'title'      => __( 'Bio Links', 'exhale' ),
			'categories' => [ 'profile' ]
		] );

		$this->registerPattern( 'book-card', [
			'title' => __( 'Book Card', 'exhale' ),
			'categories' => [ 'book' ],
			'viewportWidth' => $width_alignwide
		] );

		$this->registerPattern( 'book-card-emoji', [
			'title' => __( 'Book Card (Emoji)', 'exhale' ),
			'categories' => [ 'book' ],
			'viewportWidth' => $width_alignwide
		] );

		$this->registerPattern( 'book-card-intro', [
			'title' => __( 'Book Card Intro', 'exhale' ),
			'categories' => [ 'book' ],
			'viewportWidth' => $width_alignwide
		] );

		$this->registerPattern( 'columns-connect-boxes', [
			'title' => __( 'Columns: Connect Boxes', 'exhale' ),
			'categories' => [ 'columns', 'profile' ]
		] );

		$this->registerPattern( 'columns-cards', [
			'title' => __( 'Columns: Cards', 'exhale' ),
			'categories' => [ 'columns' ]
		] );

		$this->registerPattern( 'columns-cards-horizontal', [
			'title' => __( 'Columns: Cards Horizontal', 'exhale' ),
			'categories' => [ 'columns' ]
		] );

		$this->registerPattern( 'columns-movie-posters', [
			'title' => __( 'Columns: Movie Posters', 'exhale' ),
			'categories' => [ 'columns' ]
		] );

		$this->registerPattern( 'columns-square-image-text-boxes', [
			'title' => __( 'Columns: Square Image Text Boxes', 'exhale' ),
			'categories' => [ 'columns' ]
		] );

		$this->registerPattern( 'columns-team-portraits', [
			'title' => __( 'Columns: Team Portraits', 'exhale' ),
			'categories' => [ 'columns', 'team' ]
		] );

		$this->registerPattern( 'cover-inner-border', [
			'title' => __( 'Cover: Inner Border', 'exhale' ),
			'categories' => [ 'cover' ]
		] );

		$this->registerPattern( 'cover-quote', [
			'title' => __( 'Cover: Quote', 'exhale' ),
			'categories' => [ 'cover', 'quote' ]
		] );

		$this->registerPattern( 'cover-search', [
			'title' => __( 'Cover: Search', 'exhale' ),
			'categories' => [ 'cover', 'forms' ]
		] );

		$this->registerPattern( 'cover-splash-social', [
			'title' => __( 'Cover: Splash Social', 'exhale' ),
			'categories' => [ 'cover' ]
		] );

		$this->registerPattern( 'gallery-text-grid', [
			'title' => __( 'Gallery: Text Grid', 'exhale' ),
			'viewportWidth' => $width_alignwide + 64,
			'categories' => [ 'gallery' ]
		] );

		$this->registerPattern( 'hero-adventure', [
			'title' => __( 'Hero: Adventure', 'exhale' ),
			'categories' => [ 'cover' ]
		] );

		$this->registerPattern( 'hero-camping', [
			'title' => __( 'Hero: Camping', 'exhale' ),
			'categories' => [ 'cover' ]
		] );

		$this->registerPattern( 'hero-header-with-data', [
			'title' => __( 'Hero: Header with Data', 'exhale' ),
			'categories' => [ 'cover' ]
		] );

		$this->registerPattern( 'hero-intro-portfolio', [
			'title' => __( 'Hero: Intro Portfolio', 'exhale' ),
			'categories' => [ 'cover' ]
		] );

		$this->registerPattern( 'hero-search', [
			'title' => __( 'Hero: Search', 'exhale' ),
			'categories' => [ 'forms' ]
		] );

		$this->registerPattern( 'hero-video-space', [
			'title' => __( 'Hero: Video Space', 'exhale' ),
			'categories' => [ 'cover' ]
		] );

		$this->registerPattern( 'media-text-post-header', [
			'title' => __( 'Media & Text: Post Header', 'exhale' )
		] );

		$this->registerPattern( 'portfolio-photographer-intro', [
			'title' => __( 'Portfolio: Photographer Intro', 'exhale' )
		] );

		$this->registerPattern( 'portfolio-single-project-gallery', [
			'title' => __( 'Portfolio: Single Project Gallery', 'exhale' )
		] );

		$this->registerPattern( 'portfolio-single-project-wide', [
			'title' => __( 'Portfolio: Single Project Wide', 'exhale' )
		] );

		$this->registerPattern( 'post-header-long-read', [
			'title' => __( 'Post Header: Long Read', 'exhale' )
		] );

		$this->registerPattern( 'pricing-three-columns', [
			'title' => __( 'Pricing: 3 Columns', 'exhale' ),
			'categories' => [ 'columns' ],
			'viewportWidth' => $width_alignwide
		] );

		$this->registerPattern( 'query-cards', [
			'title' => __( 'Query: Cards', 'exhale' ),
			'categories' => [ 'query' ],
			'blockTypes' => [ 'core/query' ]
		] );

		$this->registerPattern( 'quote-cover-testimonial', [
			'title' => __( 'Quote: Cover Testimonial', 'exhale' ),
			'viewportWidth' => $width_alignwide + 64
		] );

		$this->registerPattern( 'recipe-card-hero', [
			'title' => __( 'Recipe Card: Hero', 'exhale' ),
			'categories' => [ 'recipe' ],
			'viewportWidth' => $width_content
		] );

		$this->registerPattern( 'recipe-card-hero-alt', [
			'title' => __( 'Recipe Card: Hero Alt', 'exhale' ),
			'categories' => [ 'recipe' ],
			'viewportWidth' => $width_content
		] );

		$this->registerPattern( 'recipe-card-circle', [
			'title' => __( 'Recipe Card: Circle', 'exhale' ),
			'categories' => [ 'recipe' ],
			'viewportWidth' => $width_content
		] );

		$this->registerPattern( 'recipe-card-cover', [
			'title' => __( 'Recipe Card: Cover', 'exhale' ),
			'categories' => [ 'recipe' ],
			'viewportWidth' => $width_content
		] );

		$this->registerPattern( 'recipe-card-cursive-mono', [
			'title' => __( 'Recipe Card: Cursive Monospace', 'exhale' ),
			'categories' => [ 'recipe' ],
			'viewportWidth' => $width_content
		] );

		$this->registerPattern( 'recipe-card-split', [
			'title' => __( 'Recipe Card: Split', 'exhale' ),
			'categories' => [ 'recipe' ],
			'viewportWidth' => $width_alignwide
		] );

		$this->registerPattern( 'shop-columns-category-covers', [
			'title' => __( 'Shop: Columns Category Covers', 'exhale' ),
			'categories' => [ 'columns', 'shop' ]
		] );

		$this->registerPattern( 'shop-hero-just-arrived', [
			'title' => __( 'Shop: Hero - Just Arrived', 'exhale' ),
			'categories' => [ 'cover', 'shop' ]
		] );

		$this->registerPattern( 'shop-hero-video', [
			'title' => __( 'Shop: Hero Video', 'exhale' ),
			'categories' => [ 'cover', 'shop' ]
		] );

		$this->registerPattern( 'shop-trending-boxes', [
			'title' => __( 'Shop: Trending Boxes', 'exhale' ),
			'categories' => [ 'shop' ]
		] );

		$this->registerPattern( 'story-life-music-death-00', [
			'title' => __( 'Story: Life Music Death - Prologue' ),
			'categories' => [ 'story' ]
		] );

		$this->registerPattern( 'story-life-music-death-01', [
			'title' => __( 'Story: Life Music Death - Chapter 1' ),
			'categories' => [ 'story' ]
		] );

		$this->registerPattern( 'story-local-fair-00', [
			'title' => __( 'Story: Local Fair' ),
			'categories' => [ 'story' ]
		] );

		$this->registerPattern( 'story-magic-city-01', [
			'title' => __( 'Story: The Magic City - Page 1' ),
			'categories' => [ 'story' ]
		] );

		$this->registerPattern( 'story-magic-city-02', [
			'title' => __( 'Story: The Magic City - Page 2' ),
			'categories' => [ 'story' ]
		] );

		$this->registerPattern( 'story-magic-city-03', [
			'title' => __( 'Story: The Magic City - Page 3' ),
			'categories' => [ 'story' ]
		] );

		$this->registerPattern( 'story-magic-city-04', [
			'title' => __( 'Story: The Magic City - Page 4' ),
			'categories' => [ 'story' ]
		] );

		$this->registerPattern( 'story-retro-70s-00', [
			'title' => __( "Story: Retro '70s - Prologue" ),
			'categories' => [ 'story' ]
		] );

		$this->registerPattern( 'story-retro-70s-01', [
			'title' => __( "Story: Retro '70s - Chapter 1" ),
			'categories' => [ 'story' ]
		] );

		$this->registerPattern( 'story-retro-70s-02', [
			'title' => __( "Story: Retro '70s - Chapter 2" ),
			'categories' => [ 'story' ]
		] );

		$this->registerPattern( 'team-cards-bio-avatar', [
			'title' => __( 'Team: Cards Bio Avatar', 'exhale' ),
			'categories' => [ 'columns' ],
			'viewportWidth' => $width_alignwide + 64
		] );

		$this->registerPattern( 'team-cards-bio-wide', [
			'title' => __( 'Team: Cards Bio Wide', 'exhale' ),
			'categories' => [ 'columns' ],
			'viewportWidth' => $width_alignwide + 64
		] );

		$this->registerPattern( 'team-cards-simple', [
			'title' => __( 'Team: Cards Simple', 'exhale' ),
			'categories' => [ 'columns' ],
			'viewportWidth' => $width_alignwide + 64
		] );

		$this->registerPattern( 'template-story-retro', [
			'title' => __( 'Template: Story - Retro', 'exhale' ),
			'categories' => [ 'magazine' ]
		] );

		// Plugin patterns.

		$registry = WP_Block_Type_Registry::get_instance();

		if ( $registry->is_registered( 'jvm/details-summary' ) ) {

			$this->registerPattern( 'jvm-details-summary-faq', [
				'title' => __( 'FAQs', 'exhale' )
			] );
		}
	}
}
