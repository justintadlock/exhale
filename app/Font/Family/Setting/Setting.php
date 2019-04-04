<?php
/**
 * Font Family Setting.
 *
 * Creates a font family setting object.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Font\Family\Setting;

use JsonSerializable;

/**
 * Font family setting class.
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
	 * Setting default (should be the name of a `Choice` object).
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string
	 */
	protected $family = 'system-ui';

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
			"exhale/font/family/setting/{$this->name}/label",
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
		return sprintf( 'font_family_%s', str_replace( '-', '_', $this->name() ) );
	}

	/**
	 * Returns the CSS custom property selector for the setting name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function property() {
		return sprintf( '--font-family-%s', $this->name() );
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
	public function family() {

		return apply_filters(
			"exhale/font/family/setting/{$this->name}/default",
			$this->family,
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
		return get_theme_mod( $this->modName(), $this->family() );
	}
}
