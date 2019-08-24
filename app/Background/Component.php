<?php
/**
 * Background component.
 *
 * Handles the theme background feature.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Background;

use Hybrid\Contracts\Bootable;
use Exhale\Background\Patterns;
use Exhale\Settings\Options;
use Exhale\Tools\Config;
use Exhale\Tools\Mod;

use function Hybrid\sprintf_theme_uri;

/**
 * Background component class.
 *
 * @since  2.2.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Holds the registered background patterns.
	 *
	 * @since  2.2.0
	 * @access protected
	 * @var    Patterns
	 */
	protected $patterns;

	/**
	 * Creates the component object.
	 *
	 * @since  2.2.0
	 * @access public
	 * @param  array  $collections
	 * @return void
	 */
	public function __construct( array $collections ) {

		foreach ( array_keys( get_object_vars( $this ) ) as $key ) {
			if ( isset( $collections[ $key ] ) ) {
				$this->$key = $collections[ $key ];
			}
		}
	}

	/**
	 * Bootstraps the class' actions/filters.
	 *
	 * @since  2.2.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		add_action( 'after_setup_theme', [ $this, 'registerDefaultPatterns' ] );

		add_filter( 'hybrid/attr/app-header',  [ $this, 'appHeaderAttr'  ]        );
		add_filter( 'hybrid/attr/app-content', [ $this, 'appContentAttr' ]        );
		add_filter( 'hybrid/attr/app-footer',  [ $this, 'appFooterAttr'  ]        );
		add_filter( 'hybrid/attr/sidebar',     [ $this, 'sidebarAttr'    ], 10, 2 );

		add_filter( 'hybrid/attr/app-header/class',  [ $this, 'appHeaderClass'  ]        );
		add_filter( 'hybrid/attr/app-content/class', [ $this, 'appContentClass' ]        );
		add_filter( 'hybrid/attr/app-footer/class',  [ $this, 'appFooterClass'  ]        );
		add_filter( 'hybrid/attr/sidebar/class',     [ $this, 'sidebarClass'    ], 10, 2 );
	}

	/**
	 * Registers the default patterns.
	 *
	 * @since  2.2.0
	 * @access public
	 * @return void
	 */
	public function registerDefaultPatterns() {

		foreach ( Config::get( 'background-patterns' ) as $name => $pattern ) {
			$this->patterns->add( $name, $pattern );
		}
	}

	/**
	 * Filters the `app-header` element and adds a background style.
	 *
	 * @since  2.2.0
	 * @access public
	 * @param  array  $attr
	 * @return array
	 */
	public function appHeaderAttr( $attr ) {
		return $this->maybeAddBackgroundStyle( 'header', $attr );
	}

	/**
	 * Filters the `app-content` element and adds a background style.
	 *
	 * @since  2.2.0
	 * @access public
	 * @param  array  $attr
	 * @return array
	 */
	public function appContentAttr( $attr ) {
		return $this->maybeAddBackgroundStyle( 'content', $attr );
	}

	/**
	 * Filters the `app-footer` element and adds a background style.
	 *
	 * @since  2.2.0
	 * @access public
	 * @param  array  $attr
	 * @return array
	 */
	public function appFooterAttr( $attr ) {
		return $this->maybeAddBackgroundStyle( 'footer', $attr );
	}

	/**
	 * Filters the `sidebar-footer` element and adds a background style.
	 *
	 * @since  2.2.0
	 * @access public
	 * @param  array   $attr
	 * @param  string  $context
	 * @return array
	 */
	public function sidebarAttr( $attr, $context ) {
		return 'footer' === $context
		       ? $this->maybeAddBackgroundStyle( 'sidebar_footer', $attr )
		       : $attr;
	}

	/**
	 * Filters the `app-header` element's classes.
	 *
	 * @since  2.2.0
	 * @access public
	 * @param  array  $classes
	 * @return array
	 */
	public function appHeaderClass( $classes ) {
		return $this->maybeAddBackgroundClass( 'header', $classes );
	}

	/**
	 * Filters the `app-content` element's classes.
	 *
	 * @since  2.2.0
	 * @access public
	 * @param  array  $classes
	 * @return array
	 */
	public function appContentClass( $classes ) {
		return $this->maybeAddBackgroundClass( 'content', $classes );
	}

	/**
	 * Filters the `app-footer` element's classes.
	 *
	 * @since  2.2.0
	 * @access public
	 * @param  array  $classes
	 * @return array
	 */
	public function appFooterClass( $classes ) {
		return $this->maybeAddBackgroundClass( 'footer', $classes );
	}

	/**
	 * Filters the `sidebar-footer` element's classes.
	 *
	 * @since  2.2.0
	 * @access public
	 * @param  array  $classes
	 * @return array
	 */
	public function sidebarClass( $classes, $context ) {
		return 'footer' === $context
		       ? $this->maybeAddBackgroundClass( 'sidebar_footer', $classes )
		       : $classes;
	}

	/**
	 * Helper method for adding a background style.
	 *
	 * @since  2.2.0
	 * @access public
	 * @param  string  $name
	 * @param  array   $attr
	 * @return array
	 */
	protected function maybeAddBackgroundStyle( $name, $attr ) {

		$type = Mod::get( "{$name}_background_type" );

		if ( ! $type ) {
			return $attr;
		}

		$image = Mod::get( "{$name}_background_image" );
		$svg   = Mod::get( "{$name}_background_svg"   );

		if ( 'svg' === $type && $svg ) {

			$pattern = $this->patterns->get( $svg );

			if ( ! isset( $attr['style'] ) ) {
				$attr['style'] = '';
			}

			$attr['style'] .= sprintf(
				'background-image: %s;',
				$pattern->cssValue(
					maybe_hash_hex_color( Mod::get( "color_{$name}_background_fill" ) ),
					floatval( Mod::get( "{$name}_background_fill_opacity" ) )
				)
			);

		} elseif ( 'image' === $type && $image ) {

			if ( ! isset( $attr['style'] ) ) {
				$attr['style'] = '';
			}

			$attr['style'] .= sprintf(
				"background-image: url('%s');",
				esc_url( sprintf_theme_uri( $image ) )
			);
		}

		return $attr;
	}

	protected function maybeAddBackgroundClass( $name, $classes ) {

		$type = Mod::get( "{$name}_background_type" );

		if ( ! $type ) {
			return $classes;
		}

		$image = Mod::get( "{$name}_background_image" );
		$svg   = Mod::get( "{$name}_background_svg"   );

		if ( $image || $svg ) {

			if ( $attachment = Mod::get( "{$name}_background_attachment" ) ) {
				$classes[] = esc_attr( "bg-{$attachment}" );
			}

			if ( $size = Mod::get( "{$name}_background_size" ) ) {
				$classes[] = esc_attr( "bg-{$size}" );
			}

			if ( $repeat = Mod::get( "{$name}_background_repeat" ) ) {
				$classes[] = esc_attr( "bg-{$repeat}" );
			}

			if ( $position = Mod::get( "{$name}_background_position" ) ) {
				$classes[] = esc_attr( "bg-{$position}" );
			}
		}

		return $classes;
	}
}
