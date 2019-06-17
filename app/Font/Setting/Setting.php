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

namespace Exhale\Font\Setting;

use JsonSerializable;
use Hybrid\App;
use Exhale\Font\Family\Families;
use Exhale\Font\Style\Styles;
use Exhale\Font\TextTransform\Transforms;
use Exhale\Font\VariantCaps\Caps;
use Exhale\Tools\CustomProperty;

/**
 * Font setting class.
 *
 * @since  1.3.0
 * @access public
 */
class Setting implements JsonSerializable {

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
	 * Setting description.
	 *
	 * @since  1.3.0
	 * @access protected
	 * @var    string
	 */
	protected $description = '';

	/**
	 * Family default.
	 *
	 * @since  1.3.0
	 * @access protected
	 * @var    string
	 */
	protected $family = 'system-ui';

	/**
	 * Style default.
	 *
	 * @since  1.3.0
	 * @access protected
	 * @var    string
	 */
	protected $style = '400';

	/**
	 * Font variant caps default.
	 *
	 * @since  1.3.0
	 * @access protected
	 * @var    string
	 */
	protected $caps = 'normal';

	/**
	 * Text transform default.
	 *
	 * @since  1.3.0
	 * @access protected
	 * @var    string
	 */
	protected $transform = 'none';

	/**
	 * Supported options.
	 *
	 * @since  1.3.0
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
	 * @since  1.3.0
	 * @access protected
	 * @var    array
	 */
	protected $required_styles = [];

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
			'name'           => $this->name(),
			'mods'           => [
				'family'    => $this->mod( 'family'    ),
				'style'     => $this->mod( 'style'     ),
				'caps'      => $this->mod( 'caps'      ),
				'transform' => $this->mod( 'transform' )
			],
			'modNames'       => [
				'family'    => $this->modName( 'family'    ),
				'style'     => $this->modName( 'style'     ),
				'caps'      => $this->modName( 'caps'      ),
				'transform' => $this->modName( 'transform' )
			],
			'requiredStyles' => $this->requiredStyles()
		];
	}

	/**
	 * Returns the setting name.
	 *
	 * @since  1.3.0
	 * @access public
	 * @return string
	 */
	public function name() {
		return $this->name;
	}

	/**
	 * Returns the setting label.
	 *
	 * @since  1.3.0
	 * @access public
	 * @return string
	 */
	public function label() {
		return $this->label ?: $this->name();
	}

	/**
	 * Returns the setting description.
	 *
	 * @since  1.3.0
	 * @access public
	 * @return string
	 */
	public function description() {
		return $this->description;
	}

	/**
	 * Returns the default family value.
	 *
	 * @since  1.3.0
	 * @access public
	 * @return string
	 */
	public function family() {
		return $this->family;
	}

	/**
	 * Returns the default style value.
	 *
	 * @since  1.3.0
	 * @access public
	 * @return string
	 */
	public function style() {
		return $this->style;
	}

	/**
	 * Returns the default font-variant-caps value.
	 *
	 * @since  1.3.0
	 * @access public
	 * @return string
	 */
	public function caps() {
		return $this->caps;
	}

	/**
	 * Returns the default text-transform value.
	 *
	 * @since  1.3.0
	 * @access public
	 * @return string
	 */
	public function transform() {
		return $this->transform;
	}

	/**
	 * Returns the setting name as a theme mod.
	 *
	 * @since  1.3.0
	 * @access public
	 * @param  string  $option
	 * @return string
	 */
	public function modName( $option = 'family' ) {

		$map = [
			'family'    => 'font_family_%s',
			'style'     => 'font_style_%s',
			'caps'      => 'font_variant_caps_%s',
			'transform' => 'text_transform_%s'
		];

		return sprintf(
			$map[ $option ],
			str_replace( '-', '_', $this->name() )
		);
	}

	/**
	 * Returns the theme mod for the setting.
	 *
	 * @since  1.3.0
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
	 * @since  1.3.0
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
	 * @since  1.3.0
	 * @access public
	 * @return array
	 */
	public function requiredStyles() {
		return $this->required_styles;
	}

	/**
	 * Returns the array of custom CSS properties.
	 *
	 * @since  1.3.0
	 * @access public
	 * @return array
	 */
	public function cssCustomProperties() {

		$properties = [];

		$family = App::resolve( Families::class )->get( $this->mod( 'family' ) );

		$properties[ 'font-family-' . $this->name() ] = new CustomProperty(
			':root',
			sprintf( '--font-family-%s', $this->name() ),
			$family->stack()
		);

		if ( $this->hasOption( 'style' ) ) {

			$style = App::resolve( Styles::class )->get( $this->mod( 'style' ) );

			$bold_weight  = $style->weight();
			$italic_style = 'italic';

			if ( ! in_array( $style->italic(), $family->styles() ) ) {
				$italic_style = 'normal';
			}

			foreach( $style->bolds() as $bold ) {

				if ( in_array( $bold, $family->styles() ) ) {
					$bold_weight = $bold;
					break;
				}
			}

			$properties[ 'font-weight-' . $this->name() ] = new CustomProperty(
				':root',
				sprintf( '--font-weight-%s', $this->name() ),
				$style->weight()
			);

			$properties[ 'font-style-' . $this->name() ] = new CustomProperty(
				':root',
				sprintf( '--font-style-%s', $this->name() ),
				$style->style()
			);

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

		if ( $this->hasOption( 'caps' ) ) {

			$cap = App::resolve( Caps::class )->get( $this->mod( 'caps' ) );

			if ( 'normal' !== $cap->cap() ) {

				$properties[ 'font-variant-caps-' . $this->name() ] = new CustomProperty (
					':root',
					sprintf( '--font-variant-caps-%s', $this->name() ),
					$cap->cap()
				);
			}
		}

		if ( $this->hasOption( 'transform' ) ) {

			$transform = App::resolve( Transforms::class )->get( $this->mod( 'transform' ) );

			if ( 'none' !== $transform->transform() ) {

				$properties[ 'text-transform-' . $this->name() ] = new CustomProperty (
					':root',
					sprintf( '--text-transform-%s', $this->name() ),
					$transform->transform()
				);
			}
		}

		return $properties;
	}
}
