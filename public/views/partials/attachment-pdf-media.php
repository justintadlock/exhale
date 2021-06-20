<!-- wp:file {
	"id":<?php echo absint( get_the_ID() ) ?>,
	"href":"<?php echo esc_url( wp_get_attachment_url( get_the_ID() ) ) ?>",
	"displayPreview":true,
	"align":"wide"
} -->
<div class="wp-block-file alignwide">
	<object class="wp-block-file__embed" data="<?php echo esc_url( wp_get_attachment_url( get_the_ID() ) ) ?>" type="application/pdf" style="width:100%;height:600px" aria-label="<?php echo esc_attr( sprintf( __( 'Embed of %s.', 'exhale' ), basename( get_attached_file( get_the_ID() ) ) ) ) ?>">
	</object>

	<a href="<?php echo esc_url( wp_get_attachment_url( get_the_ID() ) ) ?>"><?php echo esc_html( basename( get_attached_file( get_the_ID() ) ) ) ?></a>
	<a href="<?php echo esc_url( wp_get_attachment_url( get_the_ID() ) ) ?>" class="wp-block-file__button"><?php _e( 'Download', 'exhale' ) ?></a>
</div>
<!-- /wp:file -->
