<article <?php Hybrid\Attr\display( 'entry' ) ?>>

	<header class="entry__header mb-8 text-center">
		<?php Hybrid\Theme\Post\display_title( [ 'class' => 'entry__title md:max-w-4xl mx-8 sm:mx-auto my-0' ] ) ?>
	</header>

	<div class="entry__content o-content-width">
		<figure class="wp-block-image alignfull">
			<?php echo wp_get_attachment_image( get_the_ID(), 'exhale-landscape-huge', false, [ 'class' => 'aligncenter' ] ) ?>
		</figure>
		<?php the_content() ?>
		<?php $engine->display( 'nav/pagination', 'post' ) ?>
	</div>

	<div class="media-meta media-meta--image o-content-width">

		<h3 class="media-meta__title"><?php esc_html_e( 'Image Info', 'exhale' ) ?></h3>

		<ul class="media-meta__items list-none p-0 text-base">
			<?php Hybrid\Media\Meta\display( 'dimensions',        [ 'tag' => 'li', 'class' => 'media-meta__item p-2 sm:flex border-0 border-b border-solid', 'data_class' => 'media-meta__data flex-1 text-right', 'label' => __( 'Dimensions:', 'exhale' )    ] ) ?>
			<?php Hybrid\Media\Meta\display( 'created_timestamp', [ 'tag' => 'li', 'class' => 'media-meta__item p-2 sm:flex border-0 border-b border-solid', 'data_class' => 'media-meta__data flex-1 text-right', 'label' => __( 'Date:', 'exhale' )          ] ) ?>
			<?php Hybrid\Media\Meta\display( 'camera',            [ 'tag' => 'li', 'class' => 'media-meta__item p-2 sm:flex border-0 border-b border-solid', 'data_class' => 'media-meta__data flex-1 text-right', 'label' => __( 'Camera:', 'exhale' )        ] ) ?>
			<?php Hybrid\Media\Meta\display( 'aperture',          [ 'tag' => 'li', 'class' => 'media-meta__item p-2 sm:flex border-0 border-b border-solid', 'data_class' => 'media-meta__data flex-1 text-right', 'label' => __( 'Aperture:', 'exhale' )      ] ) ?>
			<?php Hybrid\Media\Meta\display( 'focal_length',      [ 'tag' => 'li', 'class' => 'media-meta__item p-2 sm:flex border-0 border-b border-solid', 'data_class' => 'media-meta__data flex-1 text-right', 'label' => __( 'Focal Length:', 'exhale' )  ] ) ?>
			<?php Hybrid\Media\Meta\display( 'iso',               [ 'tag' => 'li', 'class' => 'media-meta__item p-2 sm:flex border-0 border-b border-solid', 'data_class' => 'media-meta__data flex-1 text-right', 'label' => __( 'ISO:', 'exhale' )           ] ) ?>
			<?php Hybrid\Media\Meta\display( 'shutter_speed',     [ 'tag' => 'li', 'class' => 'media-meta__item p-2 sm:flex border-0 border-b border-solid', 'data_class' => 'media-meta__data flex-1 text-right', 'label' => __( 'Shutter Speed:', 'exhale' ) ] ) ?>
			<?php Hybrid\Media\Meta\display( 'file_name',         [ 'tag' => 'li', 'class' => 'media-meta__item p-2 sm:flex border-0 border-b border-solid', 'data_class' => 'media-meta__data flex-1 text-right', 'label' => __( 'Name:', 'exhale' )          ] ) ?>
			<?php Hybrid\Media\Meta\display( 'mime_type',         [ 'tag' => 'li', 'class' => 'media-meta__item p-2 sm:flex border-0 border-b border-solid', 'data_class' => 'media-meta__data flex-1 text-right', 'label' => __( 'Mime Type:', 'exhale' )     ] ) ?>
			<?php Hybrid\Media\Meta\display( 'file_type',         [ 'tag' => 'li', 'class' => 'media-meta__item p-2 sm:flex border-0 border-b border-solid', 'data_class' => 'media-meta__data flex-1 text-right', 'label' => __( 'Type:', 'exhale' )          ] ) ?>
			<?php Hybrid\Media\Meta\display( 'file_size',         [ 'tag' => 'li', 'class' => 'media-meta__item p-2 sm:flex border-0 border-b border-solid', 'data_class' => 'media-meta__data flex-1 text-right', 'label' => __( 'Size:', 'exhale' )          ] ) ?>
		</ul>

	</div>

</article>
