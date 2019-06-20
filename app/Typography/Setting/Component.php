<?php
/**
 * Font Setting Component.
 *
 * Manages the font setting component.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Typography\Setting;

use WP_Customize_Manager;

use Hybrid\App;
use Hybrid\Contracts\Bootable;
use Exhale\Customize\Controls\Typography as CustomizeControlTypography;
use Exhale\Typography\Font\Family\Families;
use Exhale\Typography\Font\Style\Styles;
use Exhale\Typography\Font\VariantCaps\Caps;
use Exhale\Typography\Text\Transform\Transforms;
use Exhale\Tools\Config;
use Exhale\Tools\CustomProperties;

use function Hybrid\Font\enqueue as enqueue_font;

/**
 * Font setting component class.
 *
 * @since  2.0.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Stores the font settings object.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @var    Settings
	 */
	protected $settings;

	/**
	 * CSS custom properties.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @var    CustomProperties
	 */
	protected $properties;

	/**
	 * Stores the array of collections.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @var    array
	 */
	protected $collections;

	/**
	 * Stores the font families object.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @var    Families
	 */
	protected $families;

	/**
	 * Stores the font styles object.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @var    Families
	 */
	protected $styles;

	/**
	 * Stores the font variant caps object.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @var    Caps
	 */
	protected $caps;

	/**
	 * Stores the text transforms object.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @var    Transforms
	 */
	protected $transforms;

	/**
	 * Creates the component object.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  Settings          $settings
	 * @param  CustomProperties  $settings
	 * @param  array             $collections
	 * @return void
	 */
	public function __construct( Settings $settings, CustomProperties $properties, array $collections = [] ) {

		foreach ( array_keys( get_object_vars( $this ) ) as $key ) {
			if ( isset( $collections[ $key ] ) ) {
				$this->$key = $collections[ $key ];
			}
		}

		$this->settings    = $settings;
		$this->properties  = $properties;
		$this->collections = $collections;
	}

	/**
	 * Bootstraps the component.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		// Run registration on `after_setup_theme`.
		add_action( 'after_setup_theme', [ $this, 'register' ] );

		// Register default settings.
		add_action( 'exhale/typography/setting/register', [ $this, 'registerDefaultSettings' ] );

		// Add customizer settings and controls.
		add_action( 'customize_register', [ $this, 'customizeRegister'] );

		// Enqueue fonts.
		add_action( 'wp_enqueue_scripts',          [ $this, 'enqueue' ], 5 );
		add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue' ], 5 );
	}

	/**
	 * Runs the register actions.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		// Hook for registering settings.
		do_action( 'exhale/typography/setting/register', $this->settings );

		// Adds each font setting as a custom property.
		foreach ( $this->settings as $setting ) {
			$this->properties->add( 'typography-' . $setting->name(), $setting );
		}
	}

	/**
	 * Registers default settings.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  Settings  $settings
	 * @return void
	 */
	public function registerDefaultSettings( Settings $settings ) {

		// Base configuration.
		$base = Config::get( '_settings-typography' );

		// Back-compat with child themes that registered a config of
		// `config/settings-font-family.php` pre-2.0.
		if ( is_child_theme() ) {
			$config = Config::get( 'settings-font-family' );
		}

		$config = $config ?: Config::get( 'settings-typography' );

		$config = is_array( $config ) ? $config : [];

		foreach ( $base as $name => $options ) {

			if ( isset( $config[ $name ] ) ) {
				$options = array_merge( $options, $config[ $name ] );
			}

			$value = [
				'options'     => $options,
				'collections' => $this->collections
			];

			$settings->add( $name, $value );
		}
	}

	/**
	 * Enqueues any scripts/styles necessary for font settings.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		$fonts = $this->googleFonts();

		if ( $fonts ) {
			enqueue_font( 'exhale', [
				'family' => $fonts,
				'subset' => [
					'latin',
					'latin-ext'
				]
			] );
		}
	}

	/**
	 * Returns an array of Google fonts to load.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @return array
	 */
	protected function googleFonts() {
		$fonts = [];

		foreach ( $this->settings as $setting ) {

			$family = $this->families->get( $setting->mod() );

			$font_styles = [ '400', '400i', '700', '700i' ];

			if ( is_customize_preview() ) {

				$font_styles = $family->styles();

			} elseif ( $setting->hasOption( 'style' ) ) {

				$style = $this->styles->get( $setting->mod( 'style' ) );

				$font_styles = [
					$style->normal(),
					$style->italic()
				];

				foreach( $style->bolds() as $bold ) {

					if ( in_array( $bold, $family->styles() ) ) {
						$font_styles[] = $bold;
						break;
					}
				}

				foreach( $style->boldItalics() as $b_italic ) {

					if ( in_array( $b_italic, $family->styles() ) ) {
						$font_styles[] = $b_italic;
						break;
					}
				}

				$font_styles = array_unique( $font_styles );
			}

			if ( $family->isGoogleFont() && ! isset( $fonts[ $family->name() ] ) ) {
				$fonts[ $family->name() ] = sprintf(
					'%s:%s',
					$family->googleName(),
					join( ',', $font_styles )
				);
			}
		}

		return $fonts;
	}

	/**
	 * Customize register callback.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function customizeRegister( WP_Customize_Manager $manager ) {

		// Registers the font settings and controls.
		array_map( function( $setting ) use ( $manager ) {

			// Bail if the setting doesn't handle the font family.
			// In the future we'll allow this.
			if ( ! $setting->hasOption( 'family' ) ) {
				return;
			}

			// Set up the default control arguments.
			$control = [
				'section'     => 'typography',
				'label'       => $setting->label(),
				'description' => $setting->description(),
				'settings'    => [],
				'family'      => [],
				'style'       => [],
				'caps'        => [],
				'transform'   => []
			];

			// If the setting has the family option.
			if ( $setting->hasOption( 'family' ) ) {

				// Add the family setting name to the control.
				$control['settings']['family'] = $setting->modName( 'family' );

				// Add the family choices to the control.
				$control['family']['choices'] = $this->families->customizeChoices(
					$setting->requiredStyles()
				);

				// Register the family setting.
				$manager->add_setting( $setting->modName( 'family' ), [
					'default'           => $setting->family(),
					'sanitize_callback' => 'sanitize_key',
					'transport'         => 'postMessage'
				] );
			}

			// If the setting has the style option.
			if ( $setting->hasOption( 'style' ) ) {

				// Add the style setting name to the control.
				$control['settings']['style'] = $setting->modName( 'style' );

				// Add the style choices to the control.
				$limit = $setting->hasOption( 'family' )
				         ? $this->families->get( $setting->mod() )->styles()
				         : [];

				$control['style']['choices'] = $this->styles->customizeChoices( $limit );

				// Register the family setting.
				$manager->add_setting( $setting->modName( 'style' ), [
					'default'           => $setting->style(),
					'sanitize_callback' => 'sanitize_key',
					'transport'         => 'postMessage'
				] );
			}

			// If the setting has the text-transform option.
			if ( $setting->hasOption( 'transform' ) ) {

				// Add the transform setting name to the control.
				$control['settings']['transform'] = $setting->modName( 'transform' );

				// Add the transform choices to the control.
				$control['transform']['choices'] = $this->transforms->customizeChoices();

				// Register the transform setting.
				$manager->add_setting( $setting->modName( 'transform' ), [
					'default'           => $setting->transform(),
					'sanitize_callback' => 'sanitize_key',
					'transport'         => 'postMessage'
				] );
			}

			// If the setting has the caps option.
			if ( $setting->hasOption( 'caps' ) ) {

				// Add the caps setting name to the control.
				$control['settings']['caps'] = $setting->modName( 'caps' );

				// Add the caps choices to the control.
				$control['caps']['choices'] = $this->caps->customizeChoices();

				// Register the caps setting.
				$manager->add_setting( $setting->modName( 'caps' ), [
					'default'           => $setting->caps(),
					'sanitize_callback' => 'sanitize_key',
					'transport'         => 'postMessage'
				] );
			}

			// Register the font control.
			$manager->add_control( new CustomizeControlTypography(
				$manager,
				sprintf( 'font_%s', $setting->name() ),
				$control
			) );

		}, $this->settings->all() );
	}
}
