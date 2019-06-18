<?php
/**
 * Color component.
 *
 * Handles the theme color feature.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Editor\Color;

use Hybrid\Contracts\Bootable;
use Exhale\Tools\Config;
use Exhale\Tools\CustomProperties;

/**
 * Color component class.
 *
 * @since  2.0.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Editor colors.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @var    Colors
	 */
	protected $colors;

	/**
	 * CSS custom properties.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @var    CustomProperties
	 */
	protected $properties;

	/**
	 * Creates the component object.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  Colors           $editor
	 * @param  CustomProperties $properties
	 * @return void
	 */
	public function __construct( Colors $colors, CustomProperties $properties ) {
		$this->colors     = $colors;
		$this->properties = $properties;
	}

	/**
	 * Bootstraps the component.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		// Run registration on `after_setup_theme`.
		add_action( 'after_setup_theme', [ $this, 'register' ] );

		// Register colors.
		add_action( 'exhale/editor/color/register', [ $this, 'registerDefaultColors' ] );
	}

	/**
	 * Runs the register action and adds theme support.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		// Hook for registering custom colors.
		do_action( 'exhale/editor/color/register', $this->colors );

		// Adds a color palette to the block editor.
		add_theme_support( 'editor-color-palette', $this->colors->palette() );

		// Adds each color as a custom property.
		foreach ( $this->colors as $color ) {

			if ( ! $color->isThemeMod() ) {
				$this->properties->add( 'editor-color-' . $color->name(), $color );
			}
		}
	}

	/**
	 * Registers default editor colors.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  Colors  $colors
	 * @return void
	 */
	public function registerDefaultColors( Colors $colors ) {

		$base = Config::get( '_editor-colors' );

		foreach ( Config::get( 'editor-colors' ) as $name => $options ) {

			if ( isset( $base[ $name ] ) ) {
				$options = array_merge( $base[ $name ], $options );
			}

			$colors->add( $name, $options );
		}
	}
}
