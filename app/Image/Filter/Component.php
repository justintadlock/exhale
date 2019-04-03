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

		// Add custom properties.
		$this->customProperties();
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
	 * Adds CSS custom properties.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @return string
	 */
	protected function customProperties() {

		$default_filter_function = get_theme_mod( 'image_default_filter_function', 'grayscale' );
		$default_filter_amount   = get_theme_mod( 'image_default_filter_amount',   0           );
		$hover_filter_amount     = get_theme_mod( 'image_hover_filter_amount',     100         );

		if ( ! $default_filter_function || 'none' === $default_filter_function ) {

			$this->properties->add( '--image-default-filter', 'none' );
			$this->properties->add( '--image-hover-filter',   'none' );

			return;
		}

		$this->properties->add( '--image-default-filter', sprintf(
			'%s( %s%% )',
			esc_html( $default_filter_function ),
			absint( $default_filter_amount )
		) );

		$this->properties->add( '--image-hover-filter', sprintf(
			'%s( %s%% )',
			esc_html( $default_filter_function ),
			absint( $hover_filter_amount )
		) );
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

		$manager->add_setting( 'image_default_filter_amount', [
			'default'           => 100,
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage'
		] );

		$manager->add_setting( 'image_hover_filter_amount', [
			'default'           => 0,
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage'
		] );

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
						'label'       => __( 'Default Filter Amount', 'exhale' ),
						'description' => __( 'Filter amount applied to all images.', 'exhale' )
					],
					'hover_amount' => [
						'label'       => __( 'Hover Filter Amount', 'exhale' ),
						'description' => __( 'Filter amount applied to linked images when they are hovered or focused.', 'exhale' )
					]
				],
				'settings'    => [
					'function'       => 'image_default_filter_function',
					'default_amount' => 'image_default_filter_amount',
					'hover_amount'   => 'image_hover_filter_amount'
				]
			] )
		);
	}
}
