<article <?php Hybrid\Attr\display( 'entry' ) ?>>

	<header class="entry__header">
		<?php Hybrid\Post\display_title() ?>
	</header>

	<div class="entry__content">
		<figure class="wp-block-image alignfull">
			<?php echo wp_get_attachment_image( get_the_ID(), 'exhale-landscape-huge', false, [ 'class' => 'aligncenter' ] ) ?>
		</figure>
		<?php the_content() ?>
		<?php Hybrid\View\display( 'nav/pagination', 'post' ) ?>
	</div>

	<div class="media-meta media-meta--image">

		<h3 class="media-meta__title"><?php esc_html_e( 'Image Info', 'exhale' ) ?></h3>

		<ul class="media-meta__items">
			<?php Hybrid\Media\display_meta( 'dimensions',        [ 'tag' => 'li', 'label' => __( 'Dimensions:', 'exhale' )    ] ) ?>
			<?php Hybrid\Media\display_meta( 'created_timestamp', [ 'tag' => 'li', 'label' => __( 'Date:', 'exhale' )          ] ) ?>
			<?php Hybrid\Media\display_meta( 'camera',            [ 'tag' => 'li', 'label' => __( 'Camera:', 'exhale' )        ] ) ?>
			<?php Hybrid\Media\display_meta( 'aperture',          [ 'tag' => 'li', 'label' => __( 'Aperture:', 'exhale' )      ] ) ?>
			<?php Hybrid\Media\display_meta( 'focal_length',      [ 'tag' => 'li', 'label' => __( 'Focal Length:', 'exhale' )  ] ) ?>
			<?php Hybrid\Media\display_meta( 'iso',               [ 'tag' => 'li', 'label' => __( 'ISO:', 'exhale' )           ] ) ?>
			<?php Hybrid\Media\display_meta( 'shutter_speed',     [ 'tag' => 'li', 'label' => __( 'Shutter Speed:', 'exhale' ) ] ) ?>
			<?php Hybrid\Media\display_meta( 'file_name',         [ 'tag' => 'li', 'label' => __( 'Name:', 'exhale' )          ] ) ?>
			<?php Hybrid\Media\display_meta( 'mime_type',         [ 'tag' => 'li', 'label' => __( 'Mime Type:', 'exhale' )     ] ) ?>
			<?php Hybrid\Media\display_meta( 'file_type',         [ 'tag' => 'li', 'label' => __( 'Type:', 'exhale' )          ] ) ?>
			<?php Hybrid\Media\display_meta( 'file_size',         [ 'tag' => 'li', 'label' => __( 'Size:', 'exhale' )          ] ) ?>
		</ul>

	</div>

</article>
