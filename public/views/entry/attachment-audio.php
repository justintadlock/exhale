<article <?php Hybrid\Attr\display( 'entry' ) ?>>

	<header class="entry__header o-content-width">
		<?php Hybrid\Post\display_title() ?>
	</header>

	<div class="entry__content o-content-width">
		<figure class="aligncenter">
			<?php Hybrid\Media\display( [ 'type' => 'audio' ] ) ?>
		</figure>
		<?php the_content() ?>
		<?php $engine->display( 'nav/pagination', 'post' ) ?>
	</div>

	<div class="media-meta media-meta--audio o-content-width">

		<h3 class="media-meta__title"><?php esc_html_e( 'Audio Info', 'exhale' ) ?></h3>

		<ul class="media-meta__items">
			<?php Hybrid\Media\display_meta( 'length_formatted', [ 'tag' => 'li', 'label' => __( 'Run Time:', 'exhale' )     ] ) ?>
			<?php Hybrid\Media\display_meta( 'artist',           [ 'tag' => 'li', 'label' => __( 'Artist:', 'exhale' )       ] ) ?>
			<?php Hybrid\Media\display_meta( 'album',            [ 'tag' => 'li', 'label' => __( 'Album:', 'exhale' )        ] ) ?>
			<?php Hybrid\Media\display_meta( 'track_number',     [ 'tag' => 'li', 'label' => __( 'Track Number:', 'exhale' ) ] ) ?>
			<?php Hybrid\Media\display_meta( 'year',             [ 'tag' => 'li', 'label' => __( 'Year:', 'exhale' )         ] ) ?>
			<?php Hybrid\Media\display_meta( 'genre',            [ 'tag' => 'li', 'label' => __( 'Genre:', 'exhale' )        ] ) ?>
			<?php Hybrid\Media\display_meta( 'file_name',        [ 'tag' => 'li', 'label' => __( 'Name:', 'exhale' )         ] ) ?>
			<?php Hybrid\Media\display_meta( 'mime_type',        [ 'tag' => 'li', 'label' => __( 'Mime Type:', 'exhale' )    ] ) ?>
			<?php Hybrid\Media\display_meta( 'file_type',        [ 'tag' => 'li', 'label' => __( 'Type:', 'exhale' )         ] ) ?>
			<?php Hybrid\Media\display_meta( 'file_size',        [ 'tag' => 'li', 'label' => __( 'Size:', 'exhale' )         ] ) ?>
		</ul>

	</div>

</article>
