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

namespace Exhale\Block\Styles;

use Hybrid\Contracts\Bootable;
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
		add_action( 'init', [ $this, 'registerStyles' ] );
	}

	public function registerStyles() {

		$styles = [
			'core-button',
			'core-buttons',
			'core-columns',
			'core-cover',
			'core-gallery',
			'core-group',
			'core-heading',
			'core-image',
			'core-list',
			'core-paragraph',
			'core-post-author',
			'core-post-comments-link',
			'core-post-date',
			'core-post-terms',
			'core-query',
			'core-quote',
			'core-separator',
			'core-social-links',
			'core-tag-cloud'
		];

		foreach ( $styles as $style ) {
			include get_theme_file_path( "lib/block-styles/{$style}.php" );
		}

		$plugin_styles = [
			'jvm/details-summary',
			'tiles/progress'
		];

		$registry = WP_Block_Type_Registry::get_instance();

		foreach ( $plugin_styles as $style ) {
			if ( $registry->is_registered( $style ) ) {
				include get_theme_file_path(
					sprintf(
						'lib/block-styles/%s.php',
						str_replace( '/', '-', $style )
					)
				);
			}
		}
	}
}
