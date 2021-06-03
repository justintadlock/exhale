<?php
/**
 * Image Size Component.
 *
 * Manages the image size component.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Image\Size;

use WP_Customize_Manager;

use Hybrid\App;
use Hybrid\Contracts\Bootable;
use Exhale\Tools\Config;

/**
 * Image size component class.
 *
 * @since  1.0.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Houses the `Sizes` collection.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var    Sizes
	 */
	protected $sizes;

	/**
	 * Default image size inserted into the editor.
	 *
	 * @since  3.0.0
	 * @access protected
	 * @var    string
	 */
	protected $default_size = 'full';

	/**
	 * Featured image size if not otherwise defined.
	 *
	 * @since  3.0.0
	 * @access protected
	 * @var    string
	 */
	protected $featured_size = 'full';

	/**
	 * Width size to scale large images down to.
	 *
	 * @since  3.0.0
	 * @access protected
	 * @var    int
	 */
	protected $threshold_width = 3480;

	/**
	 * Creates the component object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  Sizes  $sizes
	 * @return void
	 */
	public function __construct( Sizes $sizes ) {
		$this->sizes = $sizes;
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

		// Register default sizes.
		add_action( 'exhale/image/size/register', [ $this, 'registerDefaultSizes' ] );

		// Filter the image size names in the editor.
		add_filter( 'image_size_names_choose', [ $this, 'imageSizeNamesChoose' ] );

		// Filter the default featured image size.
		add_filter( 'post_thumbnail_size', [ $this, 'featuredSize' ] );

		// Filter the default image size inserted in the editor.
		add_filter( 'pre_option_image_default_size', [ $this, 'defaultSize' ] );

		// Limit the big image threshold to our largest image.
		add_filter( 'big_image_size_threshold', [ $this, 'bigImageSizeThreshold' ], 5 );
	}

	/**
	 * Runs the register action and adds image sizes to WordPress.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		// Hook for registering custom image sizes.
		do_action( 'exhale/image/size/register', $this->sizes );

		// Registers image sizes with WordPress.  Note that the
		// `post-thumbnail` size should be properly registered with the
		// `set_post_thumbnail_size()` function.
		foreach ( $this->sizes->all() as $size ) {

			if ( 'post-thumbnail' === $size->name() ) {
				set_post_thumbnail_size( $size->width(), $size->height(), $size->crop() );
			} else {
				add_image_size( $size->name(), $size->width(), $size->height(), $size->crop() );
			}

			// Make the threshold as large as our largest size.
			if ( $size->width() > $this->threshold ) {
				$this->threshold_width = $size->width();
			}

			// Set the featured image size.
			if ( $size->isFeatured() ) {
				$this->featured_size = $size->name();
			}

			// Set the default image size.
			if ( $size->isDefault() ) {
				$this->default_size = $size->name();
			}
		}
	}

	/**
	 * Filter on the `image_size_names_choose` hook to add our custom image
	 * sizes to the image size dropdown in the post editor.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array  $sizes
	 * @return array
	 */
	public function imageSizeNamesChoose( $sizes ) {

		$new_sizes = [];

		foreach ( $this->sizes->all() as $size ) {
			$new_sizes[ $size->name() ] = esc_html( $size->label() );
		}

		return array_merge( $sizes, $new_sizes );
	}

	/**
	 * Registers the theme's default image sizes.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  Sizes  $sizes
	 * @return void
	 */
	public function registerDefaultSizes( Sizes $sizes ) {

		foreach ( Config::get( 'image-sizes' ) as $name => $options ) {
			$sizes->add( $name, $options );
		}
	}

	/**
	 * Set the default image size if not already defined.
	 *
	 * @since  3.0.0
	 * @access public
	 * @param  string  $size
	 * @return string
	 */
	public function defaultSize( $size ) {
		return $size ? $size : $this->default_size;
	}

	/**
	 * Set the featured image size if not already defined.
	 *
	 * @since  3.0.0
	 * @access public
	 * @param  string  $size
	 * @return string
	 */
	public function featuredSize( $size ) {
		return ! $size || 'post-thumbnail' === $size
		       ? $this->featured_size
		       : $size;
	}

	/**
	 * Limit the big image threshold to our largest image.
	 *
	 * @since  3.0.0
	 * @access public
	 * @param  int    $threshold
	 * @return int
	 */
	public function bigSizeThreshold( $threshold ) {

		if ( $this->threshold_width > $threshold ) {
			return $this->threshold_width;
		}

		return $threshold;
	}
}
