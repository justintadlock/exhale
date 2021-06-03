<?php
/**
 * Color Editor Color.
 *
 * Creates an editor color object.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Editor\Color;

use Exhale\Tools\Mod;
use function Hybrid\hex_to_rgb;

/**
 * Editor color class.
 *
 * @since  2.0.0
 * @access public
 */
class Color {

	/**
	 * Color name.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @var    string
	 */
	protected $name;

	/**
	 * Color label.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @var    string
	 */
	protected $label;

	/**
	 * Color (hex).
	 *
	 * @since  2.0.0
	 * @access protected
	 * @var    string
	 */
	protected $color = '000000';

	/**
	 * Whether the color should be taken from theme mods.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @var    bool
	 */
	protected $is_theme_mod = false;

	/**
	 * Set up the object properties.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $name
	 * @param  array   $options
	 * @return void
	 */
	public function __construct( $name, array $options = [] ) {

		foreach ( array_keys( get_object_vars( $this ) ) as $key ) {
			if ( isset( $options[ $key ] ) ) {
				$this->$key = $options[ $key ];
			}
		}

		$this->name = $name;
	}

	/**
	 * Returns the color name.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return string
	 */
	public function name() {
		return $this->name;
	}

	/**
	 * Returns the color label.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return string
	 */
	public function label() {

		return apply_filters(
			"exhale/color/editor/{$this->name}/label",
			$this->label ?: $this->name(),
			$this
		);
	}

	/**
	 * Returns the color value.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return string
	 */
	public function color() {
		return $this->isThemeMod() ? Mod::color( $this->name() ) : $this->color;
	}

	/**
	 * Returns the hex color code.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return string
	 */
	public function hex() {
		return maybe_hash_hex_color( $this->color() );
	}

	/**
	 * Returns an array (`r`, `g`, `b`, keys) of the setting value in RGB.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return array
	 */
	public function rgb() {
		return hex_to_rgb( $this->color() );
	}

	/**
	 * Whether the color is a theme mod.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return bool
	 */
	public function isThemeMod() {
		return $this->is_theme_mod;
	}

	/**
	 * Returns the CSS property value.
	 *
	 * @since  1.1.0
	 * @access public
	 * @return string
	 */
	public function cssValue() {
		return $this->hex() ?: 'transparent';
	}
}
