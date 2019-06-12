<?php
/**
 * Theme class.
 *
 * Creates a theme object.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\ThemeManager;

use WP_Theme;

/**
 * Theme class.
 *
 * @since  1.2.0
 * @access public
 */
class Theme {

	/**
	 * Theme name.
	 *
	 * @since  1.2.0
	 * @access protected
	 * @var    string
	 */
	protected $name;

	/**
	 * Theme label.
	 *
	 * @since  1.2.0
	 * @access protected
	 * @var    string
	 */
	protected $label;

	/**
	 * Download URL.
	 *
	 * @since  1.2.0
	 * @access protected
	 * @var    string
	 */
	protected $download_url = '';

	/**
	 * Screenshot URL.
	 *
	 * @since  1.2.0
	 * @access protected
	 * @var    string
	 */
	protected $screenshot = '';

	/**
	 * `WP_Theme` object.
	 *
	 * @since  1.2.0
	 * @access protected
	 * @var    WP_Theme
	 */
	protected $wp_theme;

	/**
	 * Set up the object properties.
	 *
	 * @since  1.2.0
	 * @access public
	 * @param  string  $name
	 * @param  array   $options
	 * @return void
	 */
	public function __construct( $name, array $options = [] ) {

		foreach ( array_keys( get_object_vars( $this ) ) as $key ) {
			if ( isset( $options[ $key ] ) ) {
				$this->$key = $options[ $key ];
			}
		}

		$this->name = $name;

		// If we don't have an instance of the WP theme object, get it.
		if ( ! $this->wp_theme instanceof WP_Theme ) {
			$this->wp_theme = wp_get_theme( $this->name );
		}
	}

	/**
	 * Returns the name.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return string
	 */
	public function name() {
		return $this->name;
	}

	/**
	 * Returns the label.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return string
	 */
	public function label() {
		return $this->installed() ? $this->wp_theme->display( 'Name' ) : $this->label;
	}

	/**
	 * Conditional to check if theme is installed.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return bool
	 */
	public function installed() {
		return $this->wp_theme->exists();
	}

	/**
	 * Conditional to check if the theme is active.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return string
	 */
	public function active() {
		return $this->name() === get_stylesheet();
	}

	/**
	 * Returns the screenshot URL.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return string
	 */
	public function screenshot() {

		$screenshot = $this->installed() ? $this->wp_theme->get_screenshot() : $this->screenshot;

		$screenshot = sprintf(
			$screenshot,
			get_template_directory_uri(),
			get_stylesheet_directory_uri()
		);

		return add_query_arg(
			'version',
			wp_get_theme( get_template() )->get( 'Version' ),
			$screenshot
		);
	}

	/**
	 * Returns the download URL.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return string
	 */
	public function downloadUrl() {
		return $this->download_url;
	}

	/**
	 * Returns the activation URL.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return string
	 */
	public function activateUrl() {

		if ( ! $this->installed() ) {
			return '';
		}

		return wp_nonce_url(
			add_query_arg( [
				'action'     => 'activate',
			//	'template'   => urlencode( $this->wp_theme->get_template() ),
				'stylesheet' => urlencode( $this->wp_theme->get_stylesheet() )
			], admin_url( 'themes.php' ) ),
			'switch-theme_' . $this->wp_theme->get_stylesheet()
		);
	}

	/**
	 * Returns the customize URL.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return string
	 */
	public function customizeUrl() {

		$url = admin_url( 'customize.php' );

		if ( ! $this->active() ) {

			$url = add_query_arg( [
				'theme' => urlencode( $this->name() )
			], $url );
		}

		return $url;
	}

	/**
	 * Displays the theme "card".
	 *
	 * @since  1.2.0
	 * @access public
	 * @return void
	 */
	public function displayCard() { ?>

		<div class="theme<?= $this->active() ? ' active' : '' ?>" aria-describedby="<?= esc_attr( sprintf( '%1$s-action %1$s-name', $this->name() ) ) ?>" data-slug="<?= esc_attr( $this->name() ) ?>">

			<div class="theme-screenshot">
				<img src="<?= esc_url( $this->screenshot() ) ?>" alt="" />
			</div>

			<div class="theme-id-container">

				<h2 class="theme-name" id="<?= esc_attr( sprintf( '%s-name', $this->name() ) ) ?>">
					<?php if ( $this->active() ) : ?>
						<?php printf(
							'<span>%s</span> %s',
							esc_html__( 'Active:', 'exhale' ),
							esc_html( $this->label() )
						) ?>
					<?php else : ?>
						<?= esc_html( $this->label() ) ?>
					<?php endif ?>
				</h2>

				<div class="theme-actions">
					<?php foreach ( $this->themeActions() as $action ) : ?>
						<?= $action ?>
					<?php endforeach ?>
				</div>
			</div>

		</div>
	<?php }

	/**
	 * Returns an array of theme action links.
	 *
	 * @since  1.2.0
	 * @access private
	 * @return array
	 */
	private function themeActions() {

		$actions = [];

		if ( $this->installed() ) {

			if ( $this->active() && current_user_can( 'customize' ) ) {

				$actions[] = sprintf(
					'<a class="button button-primary load-customize hide-if-no-customize" href="%s">%s</a>',
					esc_url( $this->customizeUrl() ),
					esc_html__( 'Customize', 'exhale' )
				);
			}

			if ( ! $this->active() && current_user_can( 'switch_themes' ) ) {

				$actions[] = sprintf(
					'<a class="button activate" href="%s" aria-label="%s">%s</a>',
					esc_url( $this->activateUrl() ),
					esc_attr( sprintf( __( 'Activate %s', 'exhale' ), $this->label() ) ),
					esc_html__( 'Activate', 'exhale' )
				);
			}

			if ( ! $this->active() && current_user_can( 'customize' ) ) {

				$actions[] = sprintf(
					'<a class="button button-primary load-customize hide-if-no-customize" href="%s">%s</a>',
					esc_url( $this->customizeUrl() ),
					esc_html__( 'Live Preview', 'exhale' )
				);
			}

		} elseif ( $this->downloadUrl() ) {

			$actions[] = sprintf(
				'<a class="button button-primary" href="%s" target="_blank">%s</a>',
				esc_url( $this->downloadUrl() ),
				esc_html__( 'Download', 'exhale' )
			);
		}

		return $actions;
	}
}
