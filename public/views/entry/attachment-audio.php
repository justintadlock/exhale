<article <?php Hybrid\Attr\display( 'entry' ) ?>>

	<header class="entry__header mb-8 text-center">
		<?php Hybrid\Theme\Post\display_title( [ 'class' => 'entry__title md:max-w-4xl mx-8 sm:mx-auto my-0' ] ) ?>
	</header>

	<div class="entry__content o-content-width">
		<figure class="aligncenter">
			<?php Hybrid\Media\Grabber\display( [ 'type' => 'audio' ] ) ?>
		</figure>
		<?php the_content() ?>
		<?php $engine->display( 'nav/pagination', 'post' ) ?>
	</div>

	<div class="media-meta media-meta--audio o-content-width">

		<h3 class="media-meta__title"><?php esc_html_e( 'Audio Info', 'exhale' ) ?></h3>

		<ul class="media-meta__items list-none p-0 text-base">
			<?php Hybrid\Media\Meta\display( 'length_formatted', [ 'tag' => 'li', 'class' => 'media-meta__item p-2 sm:flex border-0 border-b border-solid', 'data_class' => 'media-meta__data flex-1 text-right', 'label' => __( 'Run Time:', 'exhale' )     ] ) ?>
			<?php Hybrid\Media\Meta\display( 'artist',           [ 'tag' => 'li', 'class' => 'media-meta__item p-2 sm:flex border-0 border-b border-solid', 'data_class' => 'media-meta__data flex-1 text-right', 'label' => __( 'Artist:', 'exhale' )       ] ) ?>
			<?php Hybrid\Media\Meta\display( 'album',            [ 'tag' => 'li', 'class' => 'media-meta__item p-2 sm:flex border-0 border-b border-solid', 'data_class' => 'media-meta__data flex-1 text-right', 'label' => __( 'Album:', 'exhale' )        ] ) ?>
			<?php Hybrid\Media\Meta\display( 'track_number',     [ 'tag' => 'li', 'class' => 'media-meta__item p-2 sm:flex border-0 border-b border-solid', 'data_class' => 'media-meta__data flex-1 text-right', 'label' => __( 'Track Number:', 'exhale' ) ] ) ?>
			<?php Hybrid\Media\Meta\display( 'year',             [ 'tag' => 'li', 'class' => 'media-meta__item p-2 sm:flex border-0 border-b border-solid', 'data_class' => 'media-meta__data flex-1 text-right', 'label' => __( 'Year:', 'exhale' )         ] ) ?>
			<?php Hybrid\Media\Meta\display( 'genre',            [ 'tag' => 'li', 'class' => 'media-meta__item p-2 sm:flex border-0 border-b border-solid', 'data_class' => 'media-meta__data flex-1 text-right', 'label' => __( 'Genre:', 'exhale' )        ] ) ?>
			<?php Hybrid\Media\Meta\display( 'file_name',        [ 'tag' => 'li', 'class' => 'media-meta__item p-2 sm:flex border-0 border-b border-solid', 'data_class' => 'media-meta__data flex-1 text-right', 'label' => __( 'Name:', 'exhale' )         ] ) ?>
			<?php Hybrid\Media\Meta\display( 'mime_type',        [ 'tag' => 'li', 'class' => 'media-meta__item p-2 sm:flex border-0 border-b border-solid', 'data_class' => 'media-meta__data flex-1 text-right', 'label' => __( 'Mime Type:', 'exhale' )    ] ) ?>
			<?php Hybrid\Media\Meta\display( 'file_type',        [ 'tag' => 'li', 'class' => 'media-meta__item p-2 sm:flex border-0 border-b border-solid', 'data_class' => 'media-meta__data flex-1 text-right', 'label' => __( 'Type:', 'exhale' )         ] ) ?>
			<?php Hybrid\Media\Meta\display( 'file_size',        [ 'tag' => 'li', 'class' => 'media-meta__item p-2 sm:flex border-0 border-b border-solid', 'data_class' => 'media-meta__data flex-1 text-right', 'label' => __( 'Size:', 'exhale' )         ] ) ?>
		</ul>

	</div>

</article>
