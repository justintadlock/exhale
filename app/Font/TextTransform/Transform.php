<?php
/**
 * Text Transform.
 *
 * Creates a text transform object.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Font\TextTransform;

use JsonSerializable;

/**
 * Text transform class.
 *
 * @since  1.3.0
 * @access public
 */
class Transform implements JsonSerializable {

	/**
	 * Setting name.
	 *
	 * @since  1.3.0
	 * @access protected
	 * @var    string
	 */
	protected $name;

	/**
	 * Setting label.
	 *
	 * @since  1.3.0
	 * @access protected
	 * @var    string
	 */
	protected $label;

	/**
	 * Default text transform.
	 *
	 * @since  1.3.0
	 * @access protected
	 * @var    string
	 */
	protected $transform;

	/**
	 * Set up the object properties.
	 *
	 * @since  1.3.0
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
	 * @since  1.3.0
	 * @access public
	 * @return array
	 */
	public function jsonSerialize() {

		return [
			'name'      => $this->name(),
			'transform' => $this->transform()
		];
	}

	/**
	 * Returns the choice name.
	 *
	 * @since  1.3.0
	 * @access public
	 * @return string
	 */
	public function name() {
		return $this->name;
	}

	/**
	 * Returns the choice label.
	 *
	 * @since  1.3.0
	 * @access public
	 * @return string
	 */
	public function label() {
		return $this->label ?: $this->name();
	}

	/**
	 * Returns the text transform.
	 *
	 * @since  1.3.0
	 * @access public
	 * @return string
	 */
	public function transform() {
		return $this->transform ?: $this->name();
	}
}
