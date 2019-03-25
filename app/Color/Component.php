<?php
/**
 * Color component.
 *
 * Handles the theme color feature.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Color;

use Hybrid\Contracts\Bootable;
use Exhale\Tools\Config;

/**
 * Color component class.
 *
 * @since  1.0.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Customize colors.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    CustomizeColors
	 */
	protected $customize_colors;

	/**
	 * Editor colors.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    EditorColors
	 */
	protected $editor_colors;


	/**
	 * Creates the component object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  CustomizeColors  $customize
	 * @param  EditorColors     $editor
	 * @return void
	 */
	public function __construct( CustomizeColors $customize, EditorColors $editor ) {
		$this->customize_colors = $customize;
		$this->editor_colors    = $editor;
	}

	/**
	 * Bootstraps the component.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		// Run registration on `after_setup_theme`.
		add_action( 'after_setup_theme', [ $this, 'register' ] );

		// Register colors.
		add_action( 'exhale/color/customize/register', [ $this, 'registerDefaultCustomizeColors' ] );
		add_action( 'exhale/color/editor/register',    [ $this, 'registerDefaultEditorColors'    ] );
	}

	/**
	 * Runs the register action and adds theme support.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		// Hook for registering custom colors.
		do_action( 'exhale/color/customize/register', $this->customize_colors );
		do_action( 'exhale/color/editor/register',    $this->editor_colors    );

		// Adds a color palette to the block editor.
		add_theme_support( 'editor-color-palette', $this->editor_colors->palette() );
	}

	/**
	 * Registers default customize colors.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  CustomizeColors  $colors
	 * @return void
	 */
	public function registerDefaultCustomizeColors( CustomizeColors $colors ) {

		foreach ( Config::get( 'customize-colors' ) as $name => $options ) {
			$colors->add( $name, $options );
		}
	}

	/**
	 * Registers default editor colors.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  EditorColors  $colors
	 * @return void
	 */
	public function registerDefaultEditorColors( EditorColors $colors ) {

		$base = Config::get( '_editor-colors' );

		foreach ( Config::get( 'editor-colors' ) as $name => $options ) {

			if ( isset( $base[ $name ] ) ) {
				$options = array_merge( $base[ $name ], $options );
			}

			$colors->add( $name, $options );
		}
	}

	/**
	 * Returns an inline style for the colors.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function inlineStyle() {

		$css = '';

		foreach ( $this->editor_colors as $color ) {

			$hex = $color->hex() ?: 'transparent';

			$css .= sprintf(
				'%s: %s;',
				esc_html( $color->property() ),
				$hex
			);
		}

		foreach ( $this->customize_colors as $color ) {

			// If this is an editor color, let's skip it b/c it was
			// already added.
			if ( $color->isEditorColor() ) {
				continue;
			}

			$hex = $color->hex() ?: 'transparent';

			$css .= sprintf(
				'%s: %s;',
				esc_html( $color->property() ),
				$hex
			);
		}

		return sprintf( ':root { %s }', $css );
	}
}
