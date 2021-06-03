<!-- wp:audio {
	"id":<?php echo absint( get_the_ID() ) ?>
} -->
<figure class="wp-block-audio">
	<audio controls src="<?php echo esc_url( wp_get_attachment_url( get_the_ID() ) ) ?>"></audio>
</figure>
<!-- /wp:audio -->
