<?php
/**
 * Font Style.
 *
 * Creates a font style object.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Typography\Font\Style;

use JsonSerializable;

/**
 * Font style choice class.
 *
 * @since  2.0.0
 * @access public
 */
class Style implements JsonSerializable {

	/**
	 * Setting name.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @var    string
	 */
	protected $name;

	/**
	 * Setting label.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @var    string
	 */
	protected $label;

	/**
	 * Font weight.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @var    int
	 */
	protected $weight = 400;

	/**
	 * Font style.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @var    string
	 */
	protected $style = 'normal';

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
	 * Returns a JSON-ready array of only the properties we'll need for use
	 * in the customize-preview JS.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return array
	 */
	public function jsonSerialize() {

		return [
			'name'   => $this->name(),
			'label'  => $this->label(),
			'weight' => $this->weight(),
			'style'  => $this->style()
		];
	}

	/**
	 * Returns the choice name.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return string
	 */
	public function name() {
		return $this->name;
	}

	/**
	 * Returns the choice label.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return string
	 */
	public function label() {
		return $this->label ?: $this->name();
	}

	/**
	 * Returns the font style.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return string
	 */
	public function style() {

		$allowed = [
			'normal',
			'italic'
		];

		return in_array( $this->style, $allowed ) ? $this->style : 'normal';
	}

	/**
	 * Returns the font weight.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return int
	 */
	public function weight() {

		$allowed = range( 100, 900, 100 );

		return in_array( $this->weight, $allowed ) ? $this->weight : 400;
	}

	/**
	 * Returns the normal style name for this font style.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return string
	 */
	public function normal() {
		return str_replace( 'i', '', $this->name() );
	}

	/**
	 * Returns the italic style name for this font style.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return string
	 */
	public function italic() {
		return sprintf( '%si', $this->normal() );
	}

	/**
	 * Returns a range of potentially bold weights for this font style.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return array
	 */
	public function bolds() {

		$bolds  = [];
		$normal = absint( $this->normal() );
		$max    = 900;

		if ( $max > $normal + 300 ) {

			$range   = range( $normal + 300, $max, 100 );
			$range[] = $normal + 200;
			$range[] = $normal + 100;

		} elseif ( $max > $normal + 200 ) {

			$range   = range( $normal + 200, $max, 100 );
			$range[] = $normal + 100;

		} elseif ( $max > $normal + 100 ) {

			$range = range( $normal + 100, $max, 100 );

		} else {

			$range = range( $normal, $max, 100 );
		}

		return $range;
	}

	/**
	 * Returns a range of potential bold-italic styles for this font style.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return array
	 */
	public function boldItalics() {
		$bold_italics = [];

		foreach ( $this->bolds() as $bold ) {
			$bold_italics[] = sprintf( '%si', $bold );
		}

		return $bold_italics;
	}
}
