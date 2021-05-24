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
		include get_theme_file_path( 'block-patterns/' . $slug . '.php' );
		return ob_get_clean();
	}

	protected function registerPattern( $slug, array $args ) {

		$args = wp_parse_args( $args, [
			'categories'    => [ 'exhale' ],
			'content'       => $this->locate( $slug ),
			'viewportWidth' => 1520
		] );

		return register_block_pattern( "exhale/{$slug}", $args );
	}

	public function registerPatterns() {


		$width_alignwide = 1024;

		register_block_pattern_category( 'exhale', [
			'label' => __( 'Exhale' )
		] );

		$this->registerPattern( 'about-me-columns', [
			'title' => __( 'About Me: Columns' )
		] );

		$this->registerPattern( 'audio-cover', [
			'title' => __( 'Audio: Cover' ),
			'viewportWidth' => $width_alignwide
		] );

		$this->registerPattern( 'audio-cover-dj', [
			'title' => __( 'Audio: Cover DJ' )
		] );

		$this->registerPattern( 'cards-framed', [
			'title' => __( 'Cards: Framed' ),
			'viewportWidth' => $width_alignwide + 64
		] );

		$this->registerPattern( 'cover-inner-border', [
			'title' => __( 'Cover: Inner Border' )
		] );

		$this->registerPattern( 'gallery-text-grid', [
			'title' => __( 'Gallery: Text Grid' ),
			'viewportWidth' => $width_alignwide + 64
		] );

		$this->registerPattern( 'hero-adventure', [
			'title' => __( 'Hero: Adventure' )
		] );

		$this->registerPattern( 'hero-camping', [
			'title' => __( 'Hero: Camping' )
		] );

		$this->registerPattern( 'hero-header-with-data', [
			'title' => __( 'Hero: Header with Data' )
		] );

		$this->registerPattern( 'hero-intro-portfolio', [
			'title' => __( 'Hero: Intro Portfolio' )
		] );

		$this->registerPattern( 'hero-video-space', [
			'title' => __( 'Hero: Video Space' )
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
			'viewportWidth' => $width_alignwide
		] );

		$this->registerPattern( 'query-cards', [
			'title' => __( 'Query: Cards' ),
			'blockTypes' => [ 'core/query' ]
		] );

		$this->registerPattern( 'quote-cover-testimonial', [
			'title' => __( 'Quote: Cover Testimonial' ),
			'viewportWidth' => $width_alignwide + 64
		] );

		$this->registerPattern( 'shop-columns-category-covers', [
			'title' => __( 'Shop: Columns Category Covers' )
		] );

		$this->registerPattern( 'shop-hero-just-arrived', [
			'title' => __( 'Shop: Hero - Just Arrived' )
		] );

		$this->registerPattern( 'shop-hero-video', [
			'title' => __( 'Shop: Hero Video' )
		] );

		$this->registerPattern( 'shop-trending-boxes', [
			'title' => __( 'Shop: Trending Boxes' )
		] );

		$this->registerPattern( 'team-cards-bio-avatar', [
			'title' => __( 'Team: Cards Bio Avatar' ),
			'viewportWidth' => $width_alignwide + 64
		] );

		$this->registerPattern( 'team-cards-bio-wide', [
			'title' => __( 'Team: Cards Bio Wide' ),
			'viewportWidth' => $width_alignwide + 64
		] );

		$this->registerPattern( 'team-cards-simple', [
			'title' => __( 'Team: Cards Simple' ),
			'viewportWidth' => $width_alignwide + 64
		] );

		$this->registerPattern( 'template-story-retro', [
			'title' => __( 'Template: Story - Retro' )
		] );
	}










}
