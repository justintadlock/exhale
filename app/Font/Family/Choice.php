<?php
/**
 * Font Family Choice.
 *
 * Creates a font family setting choice object.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Font\Family;

use JsonSerializable;

/**
 * Font family choice class.
 *
 * @since  1.0.0
 * @access public
 */
class Choice implements JsonSerializable {

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
	 * CSS-ready font stack.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    string
	 */
	protected $stack = 'system-ui';

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
			'stack' => $this->stack()
		];
	}

	/**
	 * Returns the choice name.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function name() {
		return $this->name;
	}

	/**
	 * Returns the choice label.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function label() {

		return apply_filters(
			"exhale/font/family/choice/{$this->name}/label",
			$this->label ?: $this->name(),
			$this
		);
	}

	/**
	 * Returns the font stack.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function stack() {

		return apply_filters(
			"exhale/font/family/choice/{$this->name}/stack",
			$this->stack,
			$this
		);
	}
}
