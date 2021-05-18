<?php
/**
 * Font Setting.
 *
 * Creates a font setting object.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Typography\Setting;

use JsonSerializable;
use Exhale\Typography\Font\Family\Families;
use Exhale\Tools\CustomProperty;

/**
 * Font setting class.
 *
 * @since  2.0.0
 * @access public
 */
class Setting implements JsonSerializable {

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
	 * Setting description.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @var    string
	 */
	protected $description = '';

	/**
	 * Family default.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @var    string
	 */
	protected $family = 'system-ui';

	/**
	 * Supported options.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @var    string
	 */
	protected $options = [
		'family'
	];

	/**
	 * Font styles required to exist for a font family before it can be used
	 * for this setting.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @var    array
	 */
	protected $required_styles = [];

	/**
	 * Stores the array of collections.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @var    array
	 */
	protected $collections;

	/**
	 * Set up the object properties.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $name
	 * @param  array   $options
	 * @return void
	 */
	public function __construct( $name, array $options = [], array $collections = [] ) {

		foreach ( array_keys( get_object_vars( $this ) ) as $key ) {
			if ( isset( $options[ $key ] ) ) {
				$this->$key = $options[ $key ];
			}
		}

		$this->name        = $name;
		$this->collections = $collections;
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
			'name'           => $this->name(),
			'mods'           => [
				'family'    => $this->mod( 'family'    ),
			],
			'modNames'       => [
				'family'    => $this->modName( 'family'    ),
			],
			'requiredStyles' => $this->requiredStyles()
		];
	}

	/**
	 * Returns the setting name.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return string
	 */
	public function name() {
		return $this->name;
	}

	/**
	 * Returns the setting label.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return string
	 */
	public function label() {
		return $this->label ?: $this->name();
	}

	/**
	 * Returns the setting description.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return string
	 */
	public function description() {
		return $this->description;
	}

	/**
	 * Returns the default family value.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return string
	 */
	public function family() {
		return $this->family;
	}

	/**
	 * Returns the setting name as a theme mod.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $option
	 * @return string
	 */
	public function modName( $option = 'family' ) {

		$map = [
			'family'    => 'font_family_%s'
		];

		return sprintf(
			$map[ $option ],
			str_replace( '-', '_', $this->name() )
		);
	}

	/**
	 * Returns the theme mod for the setting.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $option
	 * @return string
	 */
	public function mod( $option = 'family' ) {

		if ( method_exists( $this, $option ) ) {
			return get_theme_mod(
				$this->modName( $option ),
				$this->$option()
			);
		}

		return null;
	}

	/**
	 * Conditional check if the setting supports a given option.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $option
	 * @return string
	 */
	public function hasOption( $option = 'family' ) {
		return in_array( $option, $this->options );
	}

	/**
	 * Returns the array of styles required.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return array
	 */
	public function requiredStyles() {
		return $this->required_styles;
	}

	/**
	 * Returns the array of custom CSS properties.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return array
	 */
	public function cssCustomProperties() {

		$properties = [];

		$family = $this->collections['families']->get( $this->mod( 'family' ) );

		$properties[ 'font-family-' . $this->name() ] = new CustomProperty(
			':root, body',
			sprintf( '--font-family-%s', $this->name() ),
			$family->stack()
		);

		return $properties;
	}
}
