<?php
/**
 * Color component.
 *
 * Handles the theme color feature.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Color\Customize;

use Hybrid\Contracts\Bootable;
use Exhale\Tools\Config;
use Exhale\Tools\CustomProperties;

/**
 * Color component class.
 *
 * @since  1.0.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Customize colors.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    Colors
	 */
	protected $colors;

	/**
	 * CSS custom properties.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    CustomProperties
	 */
	protected $properties;

	/**
	 * Creates the component object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  Colors           $colors
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
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		// Run registration on `after_setup_theme`.
		add_action( 'after_setup_theme', [ $this, 'register' ] );

		// Register colors.
		add_action( 'exhale/color/customize/register', [ $this, 'registerDefaultColors' ] );
	}

	/**
	 * Runs the register action and adds theme support.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		// Hook for registering custom colors.
		do_action( 'exhale/color/customize/register', $this->colors );

		// Adds each color as a custom property.
		foreach ( $this->colors as $color ) {
			$this->properties->add( $color->property(), $color->hex() );
		}
	}

	/**
	 * Registers default customize colors.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  Colors  $colors
	 * @return void
	 */
	public function registerDefaultColors( Colors $colors ) {

		foreach ( Config::get( 'customize-colors' ) as $name => $options ) {
			$colors->add( $name, $options );
		}
	}
}
