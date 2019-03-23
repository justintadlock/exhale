<?php
/**
 * Color Setting.
 *
 * Creates a color setting object.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Color;

use JsonSerializable;
use function Hybrid\hex_to_rgb;

/**
 * Color setting class.
 *
 * @since  1.0.0
 * @access public
 */
class Setting implements JsonSerializable {

	/**
	 * Setting name.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string
	 */
	protected $name;

	/**
	 * Setting label.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string
	 */
	protected $label;

	/**
	 * Setting description.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string
	 */
	protected $description = '';

	/**
	 * Setting default (hex).
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string
	 */
	protected $default = '000000';

	/**
	 * Whether the setting should appear in the block editor.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    bool
	 */
	protected $is_editor_color = true;

	/**
	 * Whether the setting should appear in the customizer.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    bool
	 */
	protected $is_customizer_color = true;

	/**
	 * Set up the object properties.
	 *
	 * @since  1.0.0
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
	 * Returns a JSON-ready array of only the properties we'll need for use
	 * in the customize-preview JS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function jsonSerialize() {

		return [
			'modName'  => $this->modName(),
			'property' => $this->property()
		];
	}

	/**
	 * Returns the setting name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function name() {
		return $this->name;
	}

	/**
	 * Returns the setting label.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function label() {

		return apply_filters(
			"exhale/color/setting/{$this->name}/label",
			$this->label ?: $this->name(),
			$this
		);
	}

	/**
	 * Returns the setting name as a theme mod.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function modName() {
		return sprintf( 'color_%s', str_replace( '-', '_', $this->name() ) );
	}

	/**
	 * Returns the CSS custom property selector for the setting name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function property() {
		return sprintf( '--color-%s', str_replace( 'theme-', '', $this->name() ) );
	}

	/**
	 * Returns the setting description.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function description() {
		return $this->description;
	}

	/**
	 * Returns the default setting value.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function default() {

		return apply_filters(
			"exhale/color/setting/{$this->name}/default",
			$this->default,
			$this
		);
	}

	/**
	 * Returns the theme mod for the setting.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function mod() {

		return $this->isCustomizerColor()
		       ? get_theme_mod( $this->modName(), $this->default() )
		       : $this->default();
	}

	/**
	 * Returns the hex color code of the setting value.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function hex() {
		return maybe_hash_hex_color( $this->mod() );
	}

	/**
	 * Returns an array (`r`, `g`, `b`, keys) of the setting value in RGB.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function rgb() {
		return hex_to_rgb( $this->mod() );
	}

	/**
	 * Returns whether the setting should be shown in the block editor.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return bool
	 */
	public function isEditorColor() {
		return $this->is_editor_color;
	}

	/**
	 * Returns whether the setting should be shown in the customizer.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function isCustomizerColor() {
		return $this->is_customizer_color;
	}
}
