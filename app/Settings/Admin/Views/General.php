<?php
/**
 * General Settings View.
 *
 * Displays the general theme settings view (tab) on the settings page.
 *
 * @package    Exhale
 * @subpackage Admin
 * @author     Justin Tadlock <justintadlock@gmail.com>
 * @copyright  Copyright (c) 2009 - 2018, Justin Tadlock
 * @link       https://themehybrid.com/plugins/members
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Exhale\Settings\Admin\Views;

use Exhale\Settings\Options;

/**
 * General settings view class.
 *
 * @since  1.0.0
 * @access public
 */
class General extends View {

	/**
	 * Returns the view name/ID.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function name() {
		return 'general';
	}

	/**
	 * Returns the internationalized, human-readable view label.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function label() {
		return __( 'General', 'exhale' );
	}

	/**
	 * Called on the `admin_init` hook and should be used to register theme
	 * settings via the Settings API.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		// Get the current plugin settings w/o the defaults.
		$this->settings = get_option( 'exhale_settings' );

		// Register the setting.
		register_setting( 'exhale_settings', 'exhale_settings', [ $this, 'validateSettings' ] );

		// Register sections and fields.
		add_action( 'exhale/settings/admin/view/general/register', [ $this, 'registerDefaultSections' ] );
		add_action( 'exhale/settings/admin/view/general/register', [ $this, 'registerDefaultFields'   ] );
	}

	/**
	 * Called on the `load-{$page}` hook when the view is booted. Use this
	 * to add any actions or filters needed.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {
		do_action( 'exhale/settings/admin/view/general/register' );
	}

	/**
	 * Validates the settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array  $input
	 * @return array
	 */
	function validateSettings( $settings ) {

		// Checkboxes.
		$settings['classic_style']    = ! empty( $settings['classic_style']    );
		$settings['disable_emoji']    = ! empty( $settings['disable_emoji']    );
		$settings['disable_toolbar']  = ! empty( $settings['disable_toolbar']  );
		$settings['disable_wp_embed'] = ! empty( $settings['disable_wp_embed'] );

		// Integers.
		//$settings['error_page'] = absint( $settings['error_page']           );

		// Return the validated/sanitized settings.
		return $settings;
	}

	/**
	 * Registers default settings sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function registerDefaultSections() {

		$sections = [
			'editor' => [
				'label'    => __( 'Editor', 'exhale' ),
				'callback' => 'sectionEditor'
			],
			'clean_wp' => [
				'label'    => __( 'Clean WordPress', 'exhale' ),
				'callback' => 'sectionCleanWP'
			]
		];

		array_map( function( $name, $section ) {

			add_settings_section(
				$name,
				$section['label'],
				[ $this, $section['callback'] ],
				'exhale_settings'
			);

		}, array_keys( $sections ), $sections );
	}

	/**
	 * Registers default settings fields.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function registerDefaultFields() {

		$fields = [
			// Editor fields.
			'classic_style' => [
				'label'    => __( 'Classic Editor', 'exhale' ),
				'callback' => 'fieldClassicStyle',
				'section'  => 'editor'
			],

			// Clean WP fields.
			'emoji' => [
				'label'    => __( 'Emoji', 'exhale' ),
				'callback' => 'fieldEmoji',
				'section'  => 'clean_wp',
			],
			'toolbar' => [
				'label'    => __( 'Toolbar', 'exhale' ),
				'callback' => 'fieldToolbar',
				'section'  => 'clean_wp'
			],
			'embeds' => [
				'label'    => __( 'Embeds', 'exhale' ),
				'callback' => 'fieldEmbeds',
				'section'  => 'clean_wp'
			]
		];

		array_map( function( $name, $field ) {

			add_settings_field(
				$name,
				$field['label'],
				[ $this, $field['callback'] ],
				'exhale_settings',
				$field['section']
			);

		}, array_keys( $fields ), $fields );
	}

	/**
	 * Displays the editor section.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function sectionEditor() { ?>

		<p>
			<?php esc_html_e( 'Settings based on which WordPress editor that you prefer to use.', 'exhale' ) ?>
		</p>

		<?php
		$wordpress     = $GLOBALS['wp_version'];
		$gutenberg     = defined( 'GUTENBERG_VERSION' ) ? GUTENBERG_VERSION : 0;
		$wordpress_req = '5.2';
		$gutenberg_req = '5.6';

		if ( version_compare( $wordpress, $wordpress_req, '<' ) && version_compare( $gutenberg, $gutenberg_req, '<' ) ) {

			printf(
				'<p>%s</p>',
				sprintf(
					// Translators: 1 is WordPress version, 2 is Gutenberg link, 3 is Gutenberg version.
					esc_html__( 'Exhale requires at least WordPress version %1$s or %2$s version %3$s for the block editor to be styled correctly.', 'exhale' ),
					$wordpress_req,
					'<a href="https://wordpress.org/plugins/gutenberg">' . esc_html__( 'Gutenberg', 'exhale' ) . '</a>',
					$gutenberg_req
				)
			);
		}
	}

	/**
	 * Displays the clean WP section.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function sectionCleanWP() { ?>

		<p>
			<?php esc_html_e( 'Clean up unnecessary items on the front end of your site for speed improvements.', 'exhale' ) ?>
		</p>

	<?php }

	/**
	 * Displays the classic style field.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function fieldClassicStyle() { ?>

		<p>
			<label>
				<input type="checkbox" name="exhale_settings[classic_style]" value="true" <?php checked( Options::get( 'classic_style' ) ) ?> />
				<?php esc_html_e( 'Use Classic Editor Stylesheet', 'exhale' ) ?>
			</label>
		</p>

		<p class="description">
			<?php esc_html_e( 'Loads a smaller stylesheet if you are using the classic WordPress editor instead of the block editor.', 'exhale' ) ?>
		</p>

	<?php }

	/**
	 * Displays the emoji field.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function fieldEmoji() { ?>

		<p>
			<label>
				<input type="checkbox" name="exhale_settings[disable_emoji]" value="true" <?php checked( Options::get( 'disable_emoji' ) ) ?> />
				<?php esc_html_e( 'Disable Emoji Scripts', 'exhale' ) ?>
			</label>
		</p>

		<p class="description">
			<?php esc_html_e( 'All modern browsers support emoji natively. Disabling emoji scripts removes the JavaScript loaded on every page of your site for a small percentage of users on outdated browsers.', 'exhale' ) ?>
		</p>

	<?php }

	/**
	 * Displays the toolbar field.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function fieldToolbar() { ?>

		<p>
			<label>
				<input type="checkbox" name="exhale_settings[disable_toolbar]" value="true" <?php checked( Options::get( 'disable_toolbar' ) ) ?> />
				<?php esc_html_e( 'Disable Toolbar', 'exhale' ) ?>
			</label>
		</p>
		<p class="description">
			<?php esc_html_e( 'Disables the toolbar on the front end of the site, which loads additional JavaScript and CSS on every page load.', 'exhale' ) ?>
		</p>

	<?php }

	/**
	 * Displays the embeds field.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function fieldEmbeds() { ?>

		<p>
			<label>
				<input type="checkbox" name="exhale_settings[disable_wp_embed]" value="true" <?php checked( Options::get( 'disable_wp_embed' ) ) ?> />
				<?php esc_html_e( 'Disable WordPress Embeds', 'exhale' ) ?>
			</label>
		</p>

		<p class="description">
			<?php esc_html_e( 'Removes the JavaScript that allows other sites to embed your posts.', 'exhale' ) ?>
		</p>

	<?php }

	/**
	 * Renders the settings page.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function template() { ?>

		<form method="post" action="options.php">
			<?php settings_fields( 'exhale_settings' ); ?>
			<?php do_settings_sections( 'exhale_settings' ); ?>
			<?php submit_button( esc_attr__( 'Update Settings', 'exhale' ), 'primary' ); ?>
		</form>

	<?php }

	/**
	 * Displays the home posts number field.
	 *
	 * @since      1.0.0
	 * @deprecated 2.1.0
	 * @access     public
	 * @return     void
	 */
	public function fieldHomePostsNumber() {}

	/**
	 * Displays the archive posts number field.
	 *
	 * @since      1.0.0
	 * @deprecated 2.1.0
	 * @access     public
	 * @return     void
	 */
	public function fieldArchivePostsNumber() {}
}
