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
			'button',
			'buttons',
			'columns',
			'cover',
			'gallery',
			'group',
			'heading',
			'image',
			'list',
			'paragraph',
			'query',
			'quote',
			'separator',
			'social-links'
		];

		foreach ( $styles as $style ) {
			include( get_theme_file_path( "block-styles/{$style}.php" ) );
		}
	}
}
