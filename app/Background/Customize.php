<?php
/**
 * Background customize class.
 *
 * Adds customizer elements for the background component.
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
 * Background customize class.
 *
 * @since  2.2.0
 * @access public
 */
class Customize extends Customizable {

	/**
	 * Houses the collection of patterns.
	 *
	 * @since  2.2.0
	 * @access protected
	 * @var    Pattern\Patterns
	 */
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

		array_map( function( $section ) use ( $manager ) {

			$manager->add_setting( "{$section}_background_type", [
				'default'              => Mod::fallback( "{$section}_background_type" ),
				'transport'            => 'postMessage',
				'sanitize_callback'    => function( $value ) {
					return in_array( $value, [ 'image', 'svg' ] ) ? $value : '';
				}
			] );

			$manager->add_setting( "color_{$section}_background_fill", [
				'default'              => maybe_hash_hex_color( Mod::fallback( "color_{$section}_background_fill" ) ),
				'sanitize_callback'    => 'sanitize_hex_color_no_hash',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
				'transport'            => 'postMessage'
			] );

			$manager->add_setting( "{$section}_background_fill_opacity", [
				'default'              => Mod::fallback( "{$section}_background_fill_opacity" ),
				'sanitize_callback'    => 'sanitize_text_field',
				'transport'            => 'postMessage'
			] );

			$manager->add_setting( "{$section}_background_svg", [
				'default'              => Mod::fallback( "{$section}_background_svg" ),
				'sanitize_callback'    => 'sanitize_key',
				'transport'            => 'postMessage'
			] );

		}, [ 'header', 'content', 'footer', 'sidebar_footer' ] );
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

		array_map( function( $section ) use ( $manager ) {

			$manager->add_control( "{$section}_background_type", [
				'section'  => "theme_{$section}_background",
				'label'    => __( 'Background Type', 'exhale' ),
				'priority' => 25,
				'type'     => 'select',
				'choices'  => [
					''      => __( 'None',    'exhale' ),
				//	'image' => __( 'Image',   'exhale' ),
					'svg'   => __( 'Pattern', 'exhale' )
				]
			] );

			$manager->add_control(
				new WP_Customize_Color_Control( $manager, "color_{$section}_background_fill", [
					'section'         => "theme_{$section}_background",
					'label'           => __( 'Foreground Color', 'exhale' ),
					'priority'        => 25,
					'active_callback' => function() use ( $section ) {
						return 'svg' === Mod::get( "{$section}_background_type" );
					}
				] )
			);

			$manager->add_control( "{$section}_background_fill_opacity", [
				'section'     => "theme_{$section}_background",
				'label'       => __( 'Foreground Opacity', 'exhale' ),
				'priority'    => 25,
				'type'        => 'number',
				'input_attrs' => [
					'min' => '0.1',
					'max' => '1',
					'step' => '0.1'
				],
				'active_callback' => function() use ( $section ) {
					return 'svg' === Mod::get( "{$section}_background_type" );
				}
			] );

			$choices = [];

			foreach ( $this->patterns as $pattern ) {
				$choices[ $pattern->name() ] = [
					'label'    => $pattern->label(),
					'cssValue' => $pattern->cssValue(
						maybe_hash_hex_color( Mod::get( "color_{$section}_background_fill" ) ),
						Mod::get( "{$section}_background_fill_opacity" )
					)
				];
			}

			$manager->add_control(
				new BackgroundSvg( $manager, "{$section}_background_svg", [
					'section'         => "theme_{$section}_background",
					'label'           => __( 'Background Pattern', 'exhale' ),
					'choices'         => $choices,
					'background'      => Mod::color( "{$section}-background" ),
					'priority'        => 25,
					'active_callback' => function() use ( $section ) {
						return 'svg' === Mod::get( "{$section}_background_type" );
					}
				] )
			);

		}, [ 'header', 'content', 'footer', 'sidebar_footer' ] );
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
