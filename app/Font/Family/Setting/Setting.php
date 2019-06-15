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
use Hybrid\App;
use Exhale\Contracts\CssCustomProperty;
use Exhale\Font\Family\Families;
use Exhale\Font\Style\Styles;
use Exhale\Tools\CustomProperty;

/**
 * Font family setting class.
 *
 * @since  1.0.0
 * @access public
 */
class Setting implements JsonSerializable, CssCustomProperty {

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

	protected $style = '400';

	protected $options = [
		'family'
	];

	/**
	 * Font styles required to exist for a font family before it can be used
	 * for this setting.
	 *
	 * @since  1.3.0
	 * @access protected
	 * @var    array
	 */
	protected $required_styles = [];

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
			'name'           => $this->name(),
			'mod'            => $this->mod(),
			'modName'        => $this->modName(),
			'property'       => $this->property(),
			'requiredStyles' => $this->requiredStyles()
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

	public function style() {

		return $this->style;
	}

	/**
	 * Returns the theme mod for the setting.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function mod( $name = 'family' ) {

		if ( 'family' === $name ) {

			return get_theme_mod(
				sprintf( "font_{$name}_%s", str_replace( '-', '_', $this->name() ) ),
				$this->family()
			);

		} elseif ( 'style' === $name ) {

			return get_theme_mod(
				sprintf( "font_{$name}_%s", str_replace( '-', '_', $this->name() ) ),
				$this->style()
			);
		}

		return null;

		return get_theme_mod( $this->modName(), $this->family() );
	}

	public function hasOption( $option = 'family' ) {

		return in_array( $option, $this->options );
	}

	/**
	 * Returns the array of styles required.
	 *
	 * @since  1.3.0
	 * @access public
	 * @return array
	 */
	public function requiredStyles() {
		return $this->required_styles;
	}

	public function cssCustomProperties() {

		$properties = [];

		$properties[ 'font-family-' . $this->name() ] = new CustomProperty(
			':root',
			sprintf( '--font-family-%s', $this->name() ),
			App::resolve( Families::class )->get( $this->mod( 'family' ) )->stack()
		);

		if ( in_array( 'style', $this->options ) ) {

			$properties[ 'font-weight-' . $this->name() ] = new CustomProperty(
				':root',
				sprintf( '--font-weight-%s', $this->name() ),
				App::resolve( Styles::class )->get( $this->mod( 'style' ) )->weight()
			);

			$properties[ 'font-style-' . $this->name() ] = new CustomProperty(
				':root',
				sprintf( '--font-style-%s', $this->name() ),
				App::resolve( Styles::class )->get( $this->mod( 'style' ) )->style()
			);

			$style  = App::resolve( Styles::class )->get( $this->mod( 'style' ) );
			$family = App::resolve( Families::class )->get( $this->mod( 'family' ) );

			$bold_weight        = 700;

			$italic_style = false !== strpos( $style->italic(), 'i' )
			                ? 'italic'
					: 'normal';

			foreach( $style->bolds() as $bold ) {

				if ( in_array( $bold, $family->styles() ) ) {
					$bold_weight = $bold;
					break;
				}
			}

			if ( 700 !== $bold_weight ) {
				$properties[ 'font-weight-' . $this->name() . '-bold' ] = new CustomProperty(
					':root',
					sprintf( '--font-weight-%s-bold', $this->name() ),
					$bold_weight
				);
			}

			if ( 'italic' !== $italic_style ) {
				$properties[ 'font-style-' . $this->name() . '-italic' ] = new CustomProperty(
					':root',
					sprintf( '--font-style-%s-italic', $this->name() ),
					$italic_style
				);
			}
		}

		return $properties;
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
		return sprintf( '--font-family-%s', $this->name() );
	}

	/**
	 * Returns the CSS property value.
	 *
	 * @since  1.1.0
	 * @access public
	 * @return string
	 */
	public function cssValue() {
		return App::resolve( Families::class )->get( $this->mod() )->stack();
	}

	/**
	 * Returns the CSS custom property selector for the setting name.
	 *
	 * @since      1.0.0
	 * @deprecated 1.1.0
	 * @access     public
	 * @return     string
	 */
	public function property() {
		return $this->cssProperty();
	}
}
