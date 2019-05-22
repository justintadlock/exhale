<?php
/**
 * Child Themes Settings View.
 *
 * Displays the child themes view (tab) on the settings page.
 *
 * @package    Exhale
 * @subpackage Admin
 * @author     Justin Tadlock <justintadlock@gmail.com>
 * @copyright  Copyright (c) 2009 - 2018, Justin Tadlock
 * @link       https://themehybrid.com/plugins/members
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Exhale\Settings\Admin\Views;

use Exhale\ThemeManager\Themes as ThemeCollection;

/**
 * Child Themes settings view class.
 *
 * @since  1.2.0
 * @access public
 */
class Themes extends View {

	/**
	 * Collection of themes.
	 *
	 * @since  1.2.0
	 * @access protected
	 * @var    ThemeCollection
	 */
	protected $themes;

	/**
	 * Returns the view name/ID.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return string
	 */
	public function name() {
		return 'themes';
	}

	/**
	 * Returns the internationalized, human-readable view label.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return string
	 */
	public function label() {
		return __( 'Themes', 'exhale' );
	}

	/**
	 * Called on the `admin_init` hook and should be used to register theme
	 * settings via the Settings API.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return void
	 */
	public function register() {

		// Register child themes.
		add_action( 'exhale/settings/admin/view/themes/register', [ $this, 'registerDefaultThemes' ] );
	}

	/**
	 * Called on the `load-{$page}` hook when the view is booted. Use this
	 * to add any actions or filters needed.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return void
	 */
	public function boot() {
		$this->themes = new ThemeCollection();

		do_action( 'exhale/settings/admin/view/themes/register', $this->themes );
	}

	/**
	 * Registers default settings sections.
	 *
	 * @since  1.2.0
	 * @access public
	 * @param  ThemeCollection  $themes
	 * @return void
	 */
	public function registerDefaultThemes( ThemeCollection $themes ) {

		$contents = file_get_contents( get_parent_theme_file_path( 'config/themes.json' ) );
		$config   = json_decode( $contents, true );

		// Add the current theme to the collection.
		$current = get_stylesheet();
		$themes->add( $current, [] );

		// If the current theme is in the config, remove it.
		if ( isset( $config[ $current ] ) ) {
			unset( $config[ $current ] );
		}

		// Add all themes from the config.
		foreach ( $config as $slug => $options ) {
			$themes->add( $slug, $options );
		}
	}

	/**
	 * Renders the settings page.
	 *
	 * @since  1.2.0
	 * @access public
	 * @return void
	 */
	public function template() { ?>

		<div class="theme-browser">
			<div class="themes wp-clearfix">
				<?php foreach ( $this->themes as $theme ) : ?>
					<?php $theme->displayCard() ?>
				<?php endforeach ?>
			</div>
		</div>
	<?php }
}
