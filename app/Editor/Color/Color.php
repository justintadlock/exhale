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

use Exhale\Contracts\CssCustomProperty;
use Exhale\Tools\Mod;
use function Hybrid\Theme\hex_to_rgb;


/**
 * Editor color class.
 *
 * @since  2.0.0
 * @access public
 */
class Color implements CssCustomProperty {

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
	 * Returns a valid CSS selector for the property.
	 *
	 * @since  1.1.0
	 * @access public
	 * @return string
	 */
	public function cssSelector() {
		return ':root';
	}

	/**
	 * Returns the CSS property.
	 *
	 * @since  1.1.0
	 * @access public
	 * @return string
	 */
	public function cssProperty() {

		$medium = [
			'gray',
			'red',
			'orange',
			'yellow',
			'green',
			'teal',
			'blue',
			'indigo',
			'purple',
			'pink'
		];

		if ( in_array( $this->name(), $medium ) ) {
			return sprintf( '--%s-500', $this->name() );
		}

		$pattern = [
			'lightest',
			'lighter',
			'light',
			'darkest',
			'darker',
			'dark'
		];

		$replace = [
			'100',
			'300',
			'400',
			'900',
			'700',
			'600'
		];

		return sprintf( '--%s', str_replace( $pattern, $replace, $this->name() ) );
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

	/**
	 * Returns the CSS custom property selector for the color.
	 *
	 * @since      2.0.0
	 * @deprecated 1.1.0
	 * @access     public
	 * @return     string
	 */
	public function property() {
		return $this->cssProperty();
	}
}
