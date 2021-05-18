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
	 * Stores non-editor colors to print on the front end.
	 *
	 * @since  2.2.0
	 * @access protected
	 * @var    Colors
	 */
	private $app_colors;

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

		$this->app_colors = new Colors();
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
	//	add_theme_support( 'editor-color-palette', $this->colors->palette() );

		// Adds each color as a custom property.
		foreach ( $this->colors as $color ) {

			if ( ! $color->isThemeMod() ) {
				$this->properties->add( 'editor-color-' . $color->name(), $color );
			}
		}

		// Adds each front-end-only color as a custom property.
		foreach ( $this->app_colors as $color ) {

			if ( ! $color->isThemeMod() ) {
				$this->properties->add( 'app-color-' . $color->name(), $color );
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

			$name = $this->mapColor( $name );

			if ( isset( $base[ $name ] ) ) {
				$options = array_merge( $base[ $name ], $options );
			}

			$colors->add( $name, $options );
		}

		// Store non-editor colors to print on front end.
		foreach ( $base as $name => $options ) {
			if ( ! $colors->has( $name ) ) {
				$this->app_colors->add( $name, $options );
			}
		}
	}

	/**
	 * Maps an old color name to the new style.
	 *
	 * @since  2.2.0
	 * @access private
	 * @param  string  $color
	 * @return string
	 */
	private function mapColor( $color ) {

		$map = [
			'gray-darkest' => 'gray-900',
			'gray-darker' => 'gray-700',
			'gray-dark' => 'gray-600',
			'gray' => 'gray-500',
			'gray-light' => 'gray-400',
			'gray-lighter' => 'gray-300',
			'gray-lightest' => 'gray-100',
			'red-darkest' => 'red-900',
			'red-darker' => 'red-700',
			'red-dark' => 'red-600',
			'red' => 'red-500',
			'red-light' => 'red-400',
			'red-lighter' => 'red-300',
			'red-lightest' => 'red-100',
			'orange-darkest' => 'orange-900',
			'orange-darker' => 'orange-700',
			'orange-dark' => 'orange-600',
			'orange' => 'orange-500',
			'orange-light' => 'orange-400',
			'orange-lighter' => 'orange-300',
			'orange-lightest' => 'orange-100',
			'yellow-darkest' => 'yellow-900',
			'yellow-darker' => 'yellow-700',
			'yellow-dark' => 'yellow-600',
			'yellow' => 'yellow-500',
			'yellow-light' => 'yellow-400',
			'yellow-lighter' => 'yellow-300',
			'yellow-lightest' => 'yellow-100',
			'green-darkest' => 'green-900',
			'green-darker' => 'green-700',
			'green-dark' => 'green-600',
			'green' => 'green-500',
			'green-light' => 'green-400',
			'green-lighter' => 'green-300',
			'green-lightest' => 'green-100',
			'teal-darkest' => 'teal-900',
			'teal-darker' => 'teal-700',
			'teal-dark' => 'teal-600',
			'teal' => 'teal-500',
			'teal-light' => 'teal-400',
			'teal-lighter' => 'teal-300',
			'teal-lightest' => 'teal-100',
			'blue-darkest' => 'blue-900',
			'blue-darker' => 'blue-700',
			'blue-dark' => 'blue-600',
			'blue' => 'blue-500',
			'blue-light' => 'blue-400',
			'blue-lighter' => 'blue-300',
			'blue-lightest' => 'blue-100',
			'indigo-darkest' => 'indigo-900',
			'indigo-darker' => 'indigo-700',
			'indigo-dark' => 'indigo-600',
			'indigo' => 'indigo-500',
			'indigo-light' => 'indigo-400',
			'indigo-lighter' => 'indigo-300',
			'indigo-lightest' => 'indigo-100',
			'purple-darkest' => 'purple-900',
			'purple-darker' => 'purple-700',
			'purple-dark' => 'purple-600',
			'purple' => 'purple-500',
			'purple-light' => 'purple-400',
			'purple-lighter' => 'purple-300',
			'purple-lightest' => 'purple-100',
			'pink-darkest' => 'pink-900',
			'pink-darker' => 'pink-700',
			'pink-dark' => 'pink-600',
			'pink' => 'pink-500',
			'pink-light' => 'pink-400',
			'pink-lighter' => 'pink-300',
			'pink-lightest' => 'pink-100',
		];

		return isset( $map[ $color ] ) ? $map[ $color ] : $color;
	}
}
