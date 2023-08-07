<article <?php Hybrid\Attr\display( 'entry' ) ?>>

	<header class="entry__header o-content-width">
		<?php Hybrid\Theme\Post\display_title() ?>
	</header>

	<div class="entry__content o-content-width">
		<figure class="aligncenter">
			<?php Hybrid\Media\Grabber\display( [ 'type' => 'video' ] ) ?>
		</figure>
		<?php the_content() ?>
		<?php $engine->display( 'nav/pagination', 'post' ) ?>
	</div>

	<div class="media-meta media-meta--video o-content-width">

		<h3 class="media-meta__title"><?php esc_html_e( 'Video Info', 'exhale' ) ?></h3>

		<ul class="media-meta__items list-none p-0 text-base">
			<?php Hybrid\Media\Meta\display( 'length_formatted', [ 'tag' => 'li', 'class' => 'media-meta__item p-2 sm:flex border-0 border-b border-solid', 'data_class' => 'media-meta__data flex-1 text-right', 'label' => __( 'Run Time:', 'exhale' )   ] ) ?>
			<?php Hybrid\Media\Meta\display( 'dimensions',       [ 'tag' => 'li', 'class' => 'media-meta__item p-2 sm:flex border-0 border-b border-solid', 'data_class' => 'media-meta__data flex-1 text-right', 'label' => __( 'Dimensions:', 'exhale' ) ] ) ?>
			<?php Hybrid\Media\Meta\display( 'file_name',        [ 'tag' => 'li', 'class' => 'media-meta__item p-2 sm:flex border-0 border-b border-solid', 'data_class' => 'media-meta__data flex-1 text-right', 'label' => __( 'Name:', 'exhale' )       ] ) ?>
			<?php Hybrid\Media\Meta\display( 'mime_type',        [ 'tag' => 'li', 'class' => 'media-meta__item p-2 sm:flex border-0 border-b border-solid', 'data_class' => 'media-meta__data flex-1 text-right', 'label' => __( 'Mime Type:', 'exhale' )  ] ) ?>
			<?php Hybrid\Media\Meta\display( 'file_type',        [ 'tag' => 'li', 'class' => 'media-meta__item p-2 sm:flex border-0 border-b border-solid', 'data_class' => 'media-meta__data flex-1 text-right', 'label' => __( 'Type:', 'exhale' )       ] ) ?>
			<?php Hybrid\Media\Meta\display( 'file_size',        [ 'tag' => 'li', 'class' => 'media-meta__item p-2 sm:flex border-0 border-b border-solid', 'data_class' => 'media-meta__data flex-1 text-right', 'label' => __( 'Size:', 'exhale' )       ] ) ?>
		</ul>

	</div>

</article>
