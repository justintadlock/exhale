<!-- wp:file {
	"id":<?php echo absint( get_the_ID() ) ?>,
	"href":"<?php echo esc_url( wp_get_attachment_url( get_the_ID() ) ) ?>"
} -->
<div class="wp-block-file">
	<a href="<?php echo esc_url( wp_get_attachment_url( get_the_ID() ) ) ?>"><?php echo esc_html( basename( get_attached_file( get_the_ID() ) ) ) ?></a>
	<a href="<?php echo esc_url( wp_get_attachment_url( get_the_ID() ) ) ?>" class="wp-block-file__button"><?php _e( 'Download', 'exhale' ) ?></a>
</div>
<!-- /wp:file -->
