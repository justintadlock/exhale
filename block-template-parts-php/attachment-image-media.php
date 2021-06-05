<?php $image = wp_get_attachment_image_src( get_the_ID(), 'full' ) ?>

<!-- wp:image {
	"align":"wide",
	"id":<?php echo absint( get_the_ID() ) ?>,
	"sizeSlug":"full",
	"linkDestination":"none"
} -->
<figure class="wp-block-image alignwide size-full">
	<img src="<?php echo esc_url( $image[0] ) ?>" alt="<?php echo esc_attr( trim( strip_tags( get_post_meta( get_the_ID(), '_wp_attachment_image_alt', true ) ) ) ) ?>" class="<?php echo esc_attr( 'wp-image-' . get_the_ID() ) ?>"/>
</figure>
<!-- /wp:image -->
