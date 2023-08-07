<?php
/**
 * Image Filter Component.
 *
 * Manages the image filter component.
 *
 * @package   Exhale
 * @link      https://themehybrid.com/themes/exhale
 *
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2023 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 */

namespace Exhale\Image\Filter;

use Exhale\Tools\Config;
use Exhale\Tools\CustomProperties;
use Exhale\Tools\CustomProperty;
use Exhale\Tools\Mod;
use Hybrid\Contracts\Bootable;
use WP_Customize_Manager;

/**
 * Image filter component class.
 *
 * @since  1.0.0
 *
 * @access public
 */
class Component implements Bootable {

    /**
     * Houses the `Filters` collection.
     *
     * @since  1.0.0
     * @var    \Exhale\Image\Filter\Filters
     *
     * @access protected
     */
    protected $filters;

    /**
     * CSS custom properties.
     *
     * @since  1.0.0
     * @var    \Exhale\Tools\CustomProperties
     *
     * @access protected
     */
    protected $properties;

    /**
     * Creates the component object.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function __construct( Filters $filters, CustomProperties $properties ) {
        $this->filters    = $filters;
        $this->properties = $properties;
    }

    /**
     * Bootstraps the component.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function boot() {

        // Run registration on the `init` hook.
        add_action( 'init', [ $this, 'register' ], 5 );

        // Register default filters.
        add_action( 'exhale/image/filter/register', [ $this, 'registerDefaultFilters' ] );
    }

    /**
     * Runs the register action and adds image filters to WordPress.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
     */
    public function register() {

        // Hook for registering custom image filters.
        do_action( 'exhale/image/filter/register', $this->filters );

        array_map( function( $amount ) {

            $this->properties->add( "image-{$amount}-default", new CustomProperty(
                ':root',
                "--image-{$amount}-filter",
                static function() use ( $amount ) {
                    $filter_function = Mod::get( 'image_default_filter_function' );

                    if ( 'none' === $filter_function ) {
                        return 'none';
                    }

                    return sprintf(
                        '%s( %s%% )',
                        esc_html( $filter_function ),
                        absint( Mod::get( "image_{$amount}_filter_amount" ) )
                    );
                }
            ) );
        }, [ 'default', 'hover' ] );
    }

    /**
     * Registers the theme's default image filters.
     *
     * @since  1.0.0
     * @return void
     *
     * @access public
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
     * @return void
     *
     * @access public
     */
    public function customizeRegister( WP_Customize_Manager $manager ) {
    }

}
