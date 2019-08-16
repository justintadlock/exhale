<?php Hybrid\Pagination\display( 'post', [
	'container_class' => 'pagination pagination--%s clear my-16 text-center font-secondary',
	'list_class'      => 'pagination__items list-none inline-block m-0 p-0',
	'item_class'      => 'pagination__item pagination__item--%s sm:inline-block mr-3 text-sm font-700',
	'anchor_class'    => 'pagination__anchor pagination__anchor--%s block leading-none py-3 px-4 no-underline',
	'show_all'        => true,
	'prev_next'       => false,
	'title_text'      => __( 'Pages:', 'exhale' ),
	'title_class'     => 'pagination__title'
] );
