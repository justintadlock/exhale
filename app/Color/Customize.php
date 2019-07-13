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

namespace Exhale\Color;

use WP_Customize_Manager;
use WP_Customize_Color_Control;
use Exhale\Color\Setting\Settings;
use Exhale\Customize\Customizable;
use Exhale\Tools\Collection;

/**
 * Color customize class.
 *
 * @since  2.1.0
 * @access public
 */
class Customize extends Customizable {

	/**
	 * Color settings object.
	 *
	 * @since  2.1.0
	 * @access protected
	 * @var    Setting\Settings
	 */
	protected $settings;

	/**
	 * Registers customizer settings.
	 *
	 * @since  2.1.0
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function registerSettings( WP_Customize_Manager $manager ) {

		// Registers the color settings and controls.
		array_map( function( $setting ) use ( $manager ) {

			$manager->add_setting( $setting->modName(), [
				'default'              => maybe_hash_hex_color( $setting->color() ),
				'sanitize_callback'    => 'sanitize_hex_color_no_hash',
				'sanitize_js_callback' => 'maybe_hash_hex_color',
				'transport'            => 'postMessage'
			] );

		}, $this->settings->all() );
	}

	/**
	 * Registers customizer controls.
	 *
	 * @since  2.1.0
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function registerControls( WP_Customize_Manager $manager ) {

		// Registers the color settings and controls.
		array_map( function( $setting ) use ( $manager ) {

			$manager->add_control(
				new WP_Customize_Color_Control( $manager, $setting->modName(), [
					'section'     => $setting->section(),
					'label'       => esc_html( $setting->label() ),
					'description' => esc_html( $setting->description() )
				] )
			);

		}, $this->settings->all() );
	}

	/**
	* Registers JSON for the customize preview script via `wp_localize_script()`.
	*
	* @since  2.1.0
	* @access public
	* @param  Collection  $json
	* @return void
	*/
	public function previewJson( Collection $json ) {

		$json->add( 'colorSettings', $this->settings );
	}
}
