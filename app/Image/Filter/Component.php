<?php
/**
 * Image Filter Component.
 *
 * Manages the image filter component.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2018 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Image\Filter;

use Hybrid\Contracts\Bootable;
use Exhale\Tools\Config;

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
	 * Creates the component object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  Filters  $filters
	 * @return void
	 */
	public function __construct( Filters $filters ) {
		$this->filters = $filters;
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
	* Returns an inline style for the filters.
	*
	* @since  1.0.0
	* @access public
	* @return string
	*/
       public function inlineStyle() {

	       $default_filter_function = get_theme_mod( 'image_default_filter_function', 'grayscale' );
	       $default_filter_amount   = get_theme_mod( 'image_default_filter_amount',   0           );
	       $hover_filter_amount     = get_theme_mod( 'image_hover_filter_amount',     100         );

	       $css = '';

	       $css .= sprintf(
		       '--image-default-filter: %s( %s%% );',
		       esc_html( $default_filter_function ),
		       absint( $default_filter_amount )
	       );

	       $css .= sprintf(
		       '--image-hover-filter: %s( %s%% );',
		       esc_html( $default_filter_function ),
		       absint( $hover_filter_amount )
	       );

	       return sprintf( ':root { %s }', $css );
       }
}
