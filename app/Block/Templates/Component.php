<?php
/**
 * Block component.
 *
 * Handles the block feature.
 *
 * @package   Exhale
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright 2019 Justin Tadlock
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://themehybrid.com/themes/exhale
 */

namespace Exhale\Block\Templates;

use Hybrid\Contracts\Bootable;

/**
 * Block component class.
 *
 * @since  3.0.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Bootstraps the class' actions/filters.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		// @todo Needed for comments template support.
		add_filter( 'hybrid/template/path', function() {
			return 'public/views';
		} );

		add_filter( 'the_content', [ $this, 'attachmentTemplate'], 5 );

		add_filter( 'comments_template', [ $this, 'commentsTemplate'] );

		add_filter( 'default_template_types', [ $this, 'templateTypes'] );

		add_filter( 'default_wp_template_part_areas', [ $this, 'templatePartAreas'] );
	}

	/**
	 * Prepends and appends custom template output to attachment block
	 * content. Gutenberg/Core doesn't currently allow for what we need.
	 *
	 * @since  3.0.0
	 * @access public
	 * @param  string  $content
	 * @return string
	 */
	public function attachmentTemplate( $content ) {
		$post = get_post();

		if ( empty( $post->post_type ) || 'attachment' !== $post->post_type || ! is_attachment( $post->ID ) ) {
			return $content;
		}

		$allowed_types = [
			'image',
			'audio',
			'pdf',
			'video'
		];

		foreach ( $allowed_types as $type ) {

			if ( wp_attachment_is( $type, $post ) ) {

				$media = locate_template( "public/views/partials/attachment-{$type}-media.php" );
				$meta  = locate_template( "public/views/partials/attachment-{$type}-meta.php"  );

				if ( $media ) {
					ob_start();
					include $media;
					$content = ob_get_clean() . wpautop( $content );
				}

				if ( $meta ) {
					ob_start();
					include $meta;
					$content .= ob_get_clean();
				}

				return $content;
			}
		}

		$media = locate_template( "public/views/partials/attachment-media.php" );

		if ( $media ) {
			ob_start();
			include $media;
			$content = ob_get_clean() . wpautop( $content );
		}

		return $content;
	}

	public function commentsTemplate( $template ) {
		return locate_template( 'public/views/comments/default.php' );
	}

	public function templateTypes( $types ) {

		$types['single'] = [
			'title'       => __( 'Single' ),
			'description' => __( 'Template used for displaying single views of the content. This template is a fallback for the post, page, and custom post type templates, which take precedence when they exist.' ),
		];

		$types['single-post'] = [
			'title'       => __( 'Single Post' ),
			'description' => __( 'Template used to display individual posts.' ),
		];

		$types['single-page'] = [
			'title'       => __( 'Single Page' ),
			'description' => __( 'Template used to display individual pages.' ),
		];

		$types['single-attachment'] = [
			'title'       => __( 'Single Attachment (Media)' ),
			'description' => __( 'Template used to display individual media items or attachments.' ),
		];

		$types['single-attachment-image'] = [
			'title'       => __( 'Single Image Attachment' ),
			'description' => __( 'Template used to display individual images or attachments.' ),
		];

		$types['single-attachment-audio'] = [
			'title'       => __( 'Single Audio Attachment' ),
			'description' => __( 'Template used to display individual audio files or attachments.' ),
		];

		$types['single-attachment-video'] = [
			'title'       => __( 'Single Video Attachment' ),
			'description' => __( 'Template used to display individual videos or attachments.' ),
		];

		return $types;
	}

	public function templatePartAreas( $areas ) {

		$areas[] = [
			'area'        => 'content',
			'label'       => __( 'Content', 'exhale' ),
			'description' => '',
			'icon'        => 'layout',
			'area_tag'    => 'div'
		];

		$areas[] = [
			'area'        => 'loop',
			'label'       => __( 'Loop', 'exhale' ),
			'description' => '',
			'icon'        => 'layout',
			'area_tag'    => 'div'
		];

		return $areas;
	}
}
