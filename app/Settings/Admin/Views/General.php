<?php
/**
 * Handles the general settings view.
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

class General extends View {

	public function name() {
		return 'general';
	}

	public function label() {
		return __( 'General' );
	}

	public function register() {

		// Get the current plugin settings w/o the defaults.
		$this->settings = get_option( 'exhale_settings' );

		// Register the setting.
		register_setting( 'exhale_settings', 'exhale_settings', [ $this, 'validateSettings' ] );
	}

	public function boot() {

		$this->addFields();
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
		$settings['home_posts_number']    = intval( $settings['home_posts_number']    );
		$settings['archive_posts_number'] = intval( $settings['archive_posts_number'] );
		$settings['error_page']           = absint( $settings['error_page']           );

		// Return the validated/sanitized settings.
		return $settings;
	}

	protected function addFields() {

		add_settings_section( 'editor', esc_html__( 'Editor Flavor' ), [ $this, 'sectionEditor' ], 'exhale_settings' );
		add_settings_section( 'reading', esc_html__( 'Reading' ), [ $this, 'sectionReading' ], 'exhale_settings' );
		add_settings_section( 'clean_wp', esc_html__( 'Clean WordPress' ), [ $this, 'sectionCleanWP' ], 'exhale_settings' );

		// Editor fields.
		add_settings_field( 'classic_style', esc_html__( 'Classic Editor' ), [ $this, 'fieldClassicStyle' ], 'exhale_settings', 'editor' );

		// Reading fields.
		add_settings_field( 'home_posts_number', esc_html__( 'Blog Posts' ), [ $this, 'fieldHomePostsNumber' ], 'exhale_settings', 'reading' );
		add_settings_field( 'archive_posts_number', esc_html__( 'Archive Posts' ), [ $this, 'fieldArchivePostsNumber' ], 'exhale_settings', 'reading' );
		add_settings_field( 'error_page', esc_html__( '404 Page' ), [ $this, 'fieldErrorPage' ], 'exhale_settings', 'reading' );

		// Clean WP fields.
		add_settings_field( 'emoji', esc_html__( 'Emoji' ), [ $this, 'fieldEmoji' ], 'exhale_settings', 'clean_wp' );
		add_settings_field( 'toolbar', esc_html__( 'Toolbar' ), [ $this, 'fieldToolbar' ], 'exhale_settings', 'clean_wp' );
		add_settings_field( 'embeds', esc_html__( 'Embeds' ), [ $this, 'fieldEmbeds' ], 'exhale_settings', 'clean_wp' );
	}

	public function sectionEditor() { ?>

		<p>
			<?php esc_html_e( 'Settings based on which WordPress editor that you prefer to use.' ) ?>
		</p>

	<?php }

	public function sectionReading() { ?>

		<p>
			<?php esc_html_e( 'Alter the posts for specific views on the front end. By default, the numbers are set for optimal use with this theme.' ) ?>
		</p>

	<?php }

	public function sectionCleanWP() { ?>

		<p>
			<?php esc_html_e( 'Clean up unnecessary items on the front end of your site for speed improvements.' ) ?>
		</p>

	<?php }

	public function fieldClassicStyle() { ?>

		<p>
			<label>
				<input type="checkbox" name="exhale_settings[classic_style]" value="true" <?php checked( Options::get( 'classic_style' ) ) ?> />
				<?php esc_html_e( 'Use Classic Editor Stylesheet' ) ?>
			</label>
		</p>
		<p class="description">
			<?php esc_html_e( 'Loads a smaller stylesheet if you are using the classic WordPress editor instead of the block editor.' ) ?>
		</p>

	<?php }

	public function fieldHomePostsNumber() { ?>

		<label>
			<input type="number" name="exhale_settings[home_posts_number]" value="<?= esc_attr( Options::get( 'home_posts_number' ) ) ?>" min="-1" max="9999" maxlength="4" />
			<?php esc_html_e( 'Number of posts to display on the blog posts page.' ) ?>
		</label>

	<?php }

	public function fieldArchivePostsNumber() { ?>

		<label>
			<input type="number" name="exhale_settings[archive_posts_number]" value="<?= esc_attr( Options::get( 'archive_posts_number' ) ) ?>" min="-1" max="9999" maxlength="4" />
			<?php esc_html_e( 'Number of posts to display on archive pages.' ) ?>
		</label>

	<?php }

	public function fieldErrorPage() {

		$dropdown = wp_dropdown_pages( [
			'name'              => 'exhale_settings[error_page]',
			'show_option_none'  => '-',
			'option_none_value' => 0,
			'selected'          => Options::get( 'error_page' ),
			'post_status'       => [ 'private' ],
			'echo'              => false
		] ); ?>

		<p>
			<label>
				<?php if ( $dropdown ) : ?>

					<?= $dropdown ?>

				<?php else : ?>

					<select name="exhale_settings[error_page]">
						<option value="0" selected="selected"><?php esc_html_e( 'No Private Pages' ) ?></option>
					</select>

					<?php if ( current_user_can( 'publish_pages' ) ) : ?>

						<a href="<?= esc_url( add_query_arg( 'post_type', 'page', admin_url( 'post-new.php' ) ) ) ?>"><?php esc_html_e( 'Add New Page' ) ?></a>

					<?php endif ?>

				<?php endif ?>
			</label>
		</p>

		<p class="description">
			<?php esc_html_e( 'Select a page to display when a user visits a 404 error page on your site. The page must be set to private so that it will not appear on the front end.' ) ?>
		</p>

	<?php }

	public function fieldEmoji() { ?>

		<p>
			<label>
				<input type="checkbox" name="exhale_settings[disable_emoji]" value="true" <?php checked( Options::get( 'disable_emoji' ) ) ?> />
				<?php esc_html_e( 'Disable Emoji Scripts' ) ?>
			</label>
		</p>
		<p class="description">
			<?php esc_html_e( 'All modern browsers support emoji natively. Disabling emoji scripts removes the JavaScript loaded on every page of your site for a small percentage of users on outdated browsers.' ) ?>
		</p>

	<?php }

	public function fieldToolbar() { ?>

		<p>
			<label>
				<input type="checkbox" name="exhale_settings[disable_toolbar]" value="true" <?php checked( Options::get( 'disable_toolbar' ) ) ?> />
				<?php esc_html_e( 'Disable Toolbar' ) ?>
			</label>
		</p>
		<p class="description">
			<?php esc_html_e( 'Disables the toolbar on the front end of the site, which loads additional JavaScript and CSS on every page load.' ) ?>
		</p>

	<?php }

	public function fieldEmbeds() { ?>

		<p>
			<label>
				<input type="checkbox" name="exhale_settings[disable_wp_embed]" value="true" <?php checked( Options::get( 'disable_wp_embed' ) ) ?> />
				<?php esc_html_e( 'Disable WordPress Embeds' ) ?>
			</label>
		</p>
		<p class="description">
			<?php esc_html_e( 'Removes the JavaScript that allows other sites to embed your posts.' ) ?>
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
			<?php submit_button( esc_attr__( 'Update Settings' ), 'primary' ); ?>
		</form>

	<?php }
}
