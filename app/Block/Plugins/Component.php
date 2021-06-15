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

namespace Exhale\Block\Plugins;

use Hybrid\Contracts\Bootable;
use WP_Block_Type_Registry;

/**
 * Block component class.
 *
 * @since  3.0.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Bootstraps the class' actions/filters.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {
		add_action( 'enqueue_block_assets', [ $this, 'enqueueBlockAssets'] );
	}

	/**
	 * Unregisters the core block editor assets on the front end and admin.
	 *
	 * @link https://github.com/WordPress/gutenberg/issues/15007
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function enqueueBlockAssets() {

		$registry = WP_Block_Type_Registry::get_instance();

		if ( $registry->is_registered( 'dsb/details-summary-block' ) ) {

			$css = $this->formatStyle( $this->dsbDetailsSummary() );

			wp_add_inline_style( 'details-summary-block-styles', $css );
		}

		if ( $registry->is_registered( 'jvm/details-summary' ) ) {

			$css = $this->formatStyle( $this->jvmDetailsSummary() );

			wp_add_inline_style( 'jvm_details_summary-editor-css', $css );
		}

		if ( $registry->is_registered( 'tiles/progress' ) ) {

			$css = $this->formatStyle( $this->tilesProgress() );

			wp_add_inline_style( "tiles-progress-style", $css );
			wp_add_inline_style( "tiles-progress-editor-style", $css );
		}
	}

	private function formatStyle( $css ) {
		return str_replace( [ "\n", "\r", "\t" ], '', $css );
	}

	private function dsbDetailsSummary() {
		return '.wp-block-dsb-details-summary-block summary > summary.rich-text {
			display: inline-block;
		}
		[data-type=dsb\/details-summary-block] + [data-type=dsb\/details-summary-block] > details {
			margin-top: 0;
			border-top-width: 0;
		}';
	}

	private function jvmDetailsSummary() {
		return '.wp-block-jvm-details-summary summary {
			line-height: inherit;
		}
		[data-type=jvm\/details-summary] + [data-type=jvm\/details-summary] > details {
			margin-top: 0;
			border-top-width: 0;
		}';
	}

	private function tilesProgress() {
		return '.wp-block-tiles-progress {
			margin: var( --wp--custom--spacing--8 ) 0 0 0;
		}
		.wp-block-tiles-progress + .wp-block-tiles-progress {
			margin-top: var( --wp--custom--spacing--4 );
		}
		.wp-block-tiles-progress .wp-block-tiles-progress__label,
		.wp-block-tiles-progress .wp-block-tiles-progress__percentage {
			margin: 0;
		}
		.wp-block-tiles-progress .wp-block-tiles-progress__background {
			overflow: hidden;
			margin: var( --wp--custom--spacing--2 ) 0 0 0;
		}
		.wp-block-tiles-progress__meta {
			margin: 0;
		}
		.wp-block-tiles-progress__percentage {
			font-family: var( --wp--preset--font-family--mono );
		}
		.wp-block-tiles-progress.is-style-percent-side .wp-block-tiles-progress__percentage {
			margin: var( --wp--custom--spacing--2 ) 0 0 0;
		}';
	}
}
