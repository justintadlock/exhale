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
	<h3><?php _e( 'Image Info', 'exhale' ) ?></h3>
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
		<?php Hybrid\Media\display_meta( 'dimensions',        [ 'tag' => 'li', 'class' => 'media-meta__item', 'data_class' => 'media-meta__data', 'label' => __( 'Dimensions:', 'exhale' )    ] ) ?>
		<?php Hybrid\Media\display_meta( 'created_timestamp', [ 'tag' => 'li', 'class' => 'media-meta__item', 'data_class' => 'media-meta__data', 'label' => __( 'Date:', 'exhale' )          ] ) ?>
		<?php Hybrid\Media\display_meta( 'camera',            [ 'tag' => 'li', 'class' => 'media-meta__item', 'data_class' => 'media-meta__data', 'label' => __( 'Camera:', 'exhale' )        ] ) ?>
		<?php Hybrid\Media\display_meta( 'aperture',          [ 'tag' => 'li', 'class' => 'media-meta__item', 'data_class' => 'media-meta__data', 'label' => __( 'Aperture:', 'exhale' )      ] ) ?>
		<?php Hybrid\Media\display_meta( 'focal_length',      [ 'tag' => 'li', 'class' => 'media-meta__item', 'data_class' => 'media-meta__data', 'label' => __( 'Focal Length:', 'exhale' )  ] ) ?>
		<?php Hybrid\Media\display_meta( 'iso',               [ 'tag' => 'li', 'class' => 'media-meta__item', 'data_class' => 'media-meta__data', 'label' => __( 'ISO:', 'exhale' )           ] ) ?>
		<?php Hybrid\Media\display_meta( 'shutter_speed',     [ 'tag' => 'li', 'class' => 'media-meta__item', 'data_class' => 'media-meta__data', 'label' => __( 'Shutter Speed:', 'exhale' ) ] ) ?>
		<?php Hybrid\Media\display_meta( 'file_name',         [ 'tag' => 'li', 'class' => 'media-meta__item', 'data_class' => 'media-meta__data', 'label' => __( 'Name:', 'exhale' )          ] ) ?>
		<?php Hybrid\Media\display_meta( 'mime_type',         [ 'tag' => 'li', 'class' => 'media-meta__item', 'data_class' => 'media-meta__data', 'label' => __( 'Mime Type:', 'exhale' )     ] ) ?>
		<?php Hybrid\Media\display_meta( 'file_type',         [ 'tag' => 'li', 'class' => 'media-meta__item', 'data_class' => 'media-meta__data', 'label' => __( 'Type:', 'exhale' )          ] ) ?>
		<?php Hybrid\Media\display_meta( 'file_size',         [ 'tag' => 'li', 'class' => 'media-meta__item', 'data_class' => 'media-meta__data', 'label' => __( 'Size:', 'exhale' )          ] ) ?>
	</ul>
	<!-- /wp:list -->

</div>
<!-- /wp:group -->
