<?php
/**
 * Image Filter Component.
 *
 * Manages the image filter component.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Image\Filter;

use WP_Customize_Manager;

use Hybrid\Contracts\Bootable;
use Hybrid\Tools\Collection;
use Exhale\Tools\Config;
use Exhale\Tools\CustomProperties;
use Exhale\Customize\Controls;

/**
 * Image filter component class.
 *
 * @since  1.0.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Houses the `Filters` collection.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    Filters
	 */
	protected $filters;

	/**
	 * Holds the filter amount settings.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    Collection
	 */
	protected $settings;

	/**
	 * CSS custom properties.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    CustomProperties
	 */
	protected $properties;

	/**
	 * Creates the component object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  Filters          $filters
	 * @param  CustomProperties $properties
	 * @return void
	 */
	public function __construct( Filters $filters, CustomProperties $properties ) {
		$this->filters    = $filters;
		$this->properties = $properties;
		$this->settings   = new Collection();
	}

	/**
	 * Bootstraps the component.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		// Run registration on the `init` hook.
		add_action( 'init', [ $this, 'register' ], 5 );

		// Register default filters.
		add_action( 'exhale/image/filter/register', [ $this, 'registerDefaultFilters' ] );

		// Add customizer settings and controls.
		add_action( 'customize_register', [ $this, 'customizeRegister'] );
	}

	/**
	 * Runs the register action and adds image filters to WordPress.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		// Hook for registering custom image filters.
		do_action( 'exhale/image/filter/register', $this->filters );

		// Add filter amount settings.
		$this->settings->add( 'default', new Setting( 'default', [
			'amount'      => 0,
			'label'       => __( 'Default Filter Amount', 'exhale' ),
			'description' => __( 'Filter amount applied to all images.', 'exhale' )
		] ) );

		$this->settings->add( 'hover', new Setting( 'hover', [
			'amount'      => 100,
			'label'       => __( 'Hover Filter Amount', 'exhale' ),
			'description' => __( 'Filter amount applied to linked images when they are hovered or focused.', 'exhale' )
		] ) );

		// Add custom properties.
		foreach ( $this->settings as $setting ) {
			$this->properties->add( 'image-filter-' . $setting->name(), $setting );
		}
	}

	/**
	 * Registers the theme's default image filters.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  Filters  $filters
	 * @return void
	 */
	public function registerDefaultFilters( Filters $filters ) {

		foreach ( Config::get( 'image-filters' ) as $name => $options ) {
			$filters->add( $name, $options );
		}
	}

	/**
	 * Customize register callback.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  WP_Customize_Manager  $manager
	 * @return void
	 */
	public function customizeRegister( WP_Customize_Manager $manager ) {

		// Image filter settings.
		$manager->add_setting( 'image_default_filter_function', [
			'default'           => 'grayscale',
			'sanitize_callback' => 'sanitize_key',
			'transport'         => 'postMessage'
		] );

		// Image filter amount settings.
		foreach ( $this->settings->all() as $setting ) {

			$manager->add_setting( $setting->modName(), [
				'default'           => $setting->amount(),
				'sanitize_callback' => 'absint',
				'transport'         => 'postMessage'
			] );
		}

		// Image filter controls.
		$manager->add_control(
			new Controls\ImageFilter( $manager, 'image_filter', [
				'section'     => 'media',
				'filters'     => $this->filters,
				'l10n'        => [
					'function' => [
						'label'       => __( 'Image Filter', 'exhale' ),
						'description' => __( 'CSS filter function to apply to images.', 'exhale' )
					],
					'default_amount' => [
						'label'       => $this->settings->get( 'default' )->label(),
						'description' => $this->settings->get( 'default' )->description()
					],
					'hover_amount' => [
						'label'       => $this->settings->get( 'hover' )->label(),
						'description' => $this->settings->get( 'hover' )->description()
					]
				],
				'settings'    => [
					'function'       => 'image_default_filter_function',
					'default_amount' => $this->settings->get( 'default' )->modName(),
					'hover_amount'   => $this->settings->get( 'hover' )->modName()
				]
			] )
		);
	}
}
