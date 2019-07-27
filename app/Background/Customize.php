<?php
/**
 * Color customize class.
 *
 * Adds customizer elements for the color component.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Background;

use WP_Customize_Manager;
use WP_Customize_Color_Control;
use Exhale\Customize\Customizable;
use Exhale\Customize\Controls\BackgroundSvg;
use Exhale\Tools\Collection;
use Exhale\Tools\Mod;

/**
 * Color customize class.
 *
 * @since  2.2.0
 * @access public
 */
class Customize extends Customizable {

	protected $patterns;

	/**
	 * Registers customizer settings.
	 *
	 * @since  2.2.0
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function registerSettings( WP_Customize_Manager $manager ) {

		$manager->add_setting( 'color_content_background_fill', [
			'default'              => maybe_hash_hex_color( Mod::fallback( 'color_content_background_fill' ) ),
			'sanitize_callback'    => 'sanitize_hex_color_no_hash',
			'sanitize_js_callback' => 'maybe_hash_hex_color',
			'transport'            => 'postMessage'
		] );

		$manager->add_setting( 'content_background_fill_opacity', [
			'default'              => Mod::fallback( 'content_background_fill_opacity' ),
		//	'sanitize_callback'    => 'floatval',
			'transport'            => 'postMessage'
		] );

		$manager->add_setting( 'content_background_svg', [
			'default'              => Mod::fallback( 'content_background_svg' ),
			'sanitize_callback'    => 'sanitize_key',
			'transport'            => 'postMessage'
		] );
	}

	/**
	 * Registers customizer controls.
	 *
	 * @since  2.2.0
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function registerControls( WP_Customize_Manager $manager ) {

		$manager->add_control(
			new WP_Customize_Color_Control( $manager, 'color_content_background_fill', [
				'section'     => 'theme_content_background',
				'label'       => __( 'Foreground Color', 'exhale' ),
			//	'description' => esc_html( $setting->description() ),
				'priority'    => 25
			] )
		);

		$manager->add_control( 'content_background_fill_opacity', [
			'section' => 'theme_content_background',
			'label'   => __( 'Fill Opacity', 'exhale' ),
			'priority'    => 25,
			'type'    => 'number',
			'input_attrs' => [
				'min' => '0.1',
				'max' => '1',
				'step' => '0.1'
			]
		] );

		$choices = [];

		foreach ( $this->patterns as $pattern ) {
			$choices[ $pattern->name() ] = [
				'label'    => $pattern->label(),
				'cssValue' => $pattern->cssValue(
					maybe_hash_hex_color( Mod::get( 'color_content_background_fill' ) ),
					Mod::get( 'content_background_fill_opacity' )
				)
			];
		}

		$manager->add_control(
			new BackgroundSvg( $manager, 'content_background_svg', [
				'section'     => 'theme_content_background',
				'label'       => __( 'Background Pattern', 'exhale' ),
				'choices'     => $choices,
				'background'  => Mod::color( 'content-background' ),
				'priority'    => 25
			] )
		);
	}

	/**
	* Registers JSON for the customize controls script via `wp_localize_script()`.
	*
	* @since  2.2.0
	* @access public
	* @param  Collection  $json
	* @return void
	*/
	public function controlsJson( Collection $json ) {

		$json->add( 'backgroundPatterns', $this->patterns );
	}

	/**
	* Registers JSON for the customize preview script via `wp_localize_script()`.
	*
	* @since  2.2.0
	* @access public
	* @param  Collection  $json
	* @return void
	*/
	public function previewJson( Collection $json ) {

		$json->add( 'backgroundPatterns', $this->patterns );
	}
}
