<!-- wp:group {
	"style":{
		"spacing":{
			"padding":{"top":"2rem","right":"2rem","bottom":"2rem","left":"2rem"}
		},
		"border":{"style":"solid","width":1}
	},
	"backgroundColor":"neutral-100","borderColor":"neutral-300",
	"className":"media-meta"
} -->
<div class="wp-block-group has-border-color has-neutral-300-border-color has-neutral-100-background-color has-background media-meta" style="border-style:solid;border-width:1px;padding-top:2rem;padding-right:2rem;padding-bottom:2rem;padding-left:2rem">

	<!-- wp:heading {"level":3} -->
	<h3><?php _e( 'Audio Info', 'exhale' ) ?></h3>
	<!-- /wp:heading -->

	<!-- wp:list {
		"style":{
			"spacing":{
				"padding":{"top":"0px","right":"0px","bottom":"0px","left":"0px"}
			}
		},
		"className":"media-meta__items list-none",
		"fontSize":"base",
		"listType":"none"
	} -->
	<ul class="media-meta__items list-none has-base-font-size" style="padding-top:0px;padding-right:0px;padding-bottom:0px;padding-left:0px">
		<?php Hybrid\Media\display_meta( 'length_formatted', [ 'tag' => 'li', 'class' => 'media-meta__item', 'data_class' => 'media-meta__data', 'label' => __( 'Run Time:', 'exhale' )     ] ) ?>
		<?php Hybrid\Media\display_meta( 'artist',           [ 'tag' => 'li', 'class' => 'media-meta__item', 'data_class' => 'media-meta__data', 'label' => __( 'Artist:', 'exhale' )       ] ) ?>
		<?php Hybrid\Media\display_meta( 'album',            [ 'tag' => 'li', 'class' => 'media-meta__item', 'data_class' => 'media-meta__data', 'label' => __( 'Album:', 'exhale' )        ] ) ?>
		<?php Hybrid\Media\display_meta( 'track_number',     [ 'tag' => 'li', 'class' => 'media-meta__item', 'data_class' => 'media-meta__data', 'label' => __( 'Track Number:', 'exhale' ) ] ) ?>
		<?php Hybrid\Media\display_meta( 'year',             [ 'tag' => 'li', 'class' => 'media-meta__item', 'data_class' => 'media-meta__data', 'label' => __( 'Year:', 'exhale' )         ] ) ?>
		<?php Hybrid\Media\display_meta( 'genre',            [ 'tag' => 'li', 'class' => 'media-meta__item', 'data_class' => 'media-meta__data', 'label' => __( 'Genre:', 'exhale' )        ] ) ?>
		<?php Hybrid\Media\display_meta( 'file_name',        [ 'tag' => 'li', 'class' => 'media-meta__item', 'data_class' => 'media-meta__data', 'label' => __( 'Name:', 'exhale' )         ] ) ?>
		<?php Hybrid\Media\display_meta( 'mime_type',        [ 'tag' => 'li', 'class' => 'media-meta__item', 'data_class' => 'media-meta__data', 'label' => __( 'Mime Type:', 'exhale' )    ] ) ?>
		<?php Hybrid\Media\display_meta( 'file_type',        [ 'tag' => 'li', 'class' => 'media-meta__item', 'data_class' => 'media-meta__data', 'label' => __( 'Type:', 'exhale' )         ] ) ?>
		<?php Hybrid\Media\display_meta( 'file_size',        [ 'tag' => 'li', 'class' => 'media-meta__item', 'data_class' => 'media-meta__data', 'label' => __( 'Size:', 'exhale' )         ] ) ?>
	</ul>
	<!-- /wp:list -->

</div>
<!-- /wp:group -->
