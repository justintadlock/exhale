<!-- wp:video {
	"id":<?php echo absint( get_the_ID() ) ?>,
	"align":"wide"
} -->
<figure class="wp-block-video alignwide">
	<video controls src="<?php echo esc_url( wp_get_attachment_url( get_the_ID() ) ) ?>"></video>
</figure>
<!-- /wp:video -->
