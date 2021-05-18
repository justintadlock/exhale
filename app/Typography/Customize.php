<?php
/**
 * Typography customize class.
 *
 * Adds customizer elements for the typography component.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Typography;

use WP_Customize_Manager;
use Exhale\Customize\Controls;
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
	 * Typography settings object.
	 *
	 * @since  2.1.0
	 * @access protected
	 * @var    Setting\Settings
	 */
	protected $settings;

	/**
	 * Font families object.
	 *
	 * @since  2.1.0
	 * @access protected
	 * @var    Font\Family\Families
	 */
	protected $families;

	/**
	 * Registers customizer settings.
	 *
	 * @since  2.1.0
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function registerSettings( WP_Customize_Manager $manager ) {

		// Registers the font settings and controls.
		array_map( function( $setting ) use ( $manager ) {

			// Bail if the setting doesn't handle the font family.
			// In the future we'll allow this.
			if ( ! $setting->hasOption( 'family' ) ) {
				return;
			}

			// If the setting has the family option.
			if ( $setting->hasOption( 'family' ) ) {

				// Register the family setting.
				$manager->add_setting( $setting->modName( 'family' ), [
					'default'           => $setting->family(),
					'sanitize_callback' => 'sanitize_key',
					'transport'         => 'postMessage'
				] );
			}

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

		// Registers the font controls.
		array_map( function( $setting ) use ( $manager ) {

			// Bail if the setting doesn't handle the font family.
			// In the future we'll allow this.
			if ( ! $setting->hasOption( 'family' ) ) {
				return;
			}

			// Set up the default control arguments.
			$control = [
				'section'     => 'theme_global_typography',
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
			}

			// Register the font control.
			$manager->add_control( new Controls\Typography(
				$manager,
				sprintf( 'font_%s', $setting->name() ),
				$control
			) );

		}, $this->settings->all() );
	}

	/**
	* Registers JSON for the customize controls script via `wp_localize_script()`.
	*
	* @since  2.1.0
	* @access public
	* @param  Collection  $json
	* @return void
	*/
	public function controlsJson( Collection $json ) {

		$json->add( 'fontFamilies', $this->families );
	//	$json->add( 'fontStyles',   $this->styles   );
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

		$json->add( 'typographySettings', $this->settings   );
		$json->add( 'fontFamilies',       $this->families   );
	//	$json->add( 'fontStyles',         $this->styles     );
	//	$json->add( 'fontVariantCaps',    $this->caps       );
	//	$json->add( 'textTransforms',     $this->transforms );
	}
}
