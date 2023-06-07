<?php if ( has_nav_menu( $data->get( 'location' ) ) ) : ?>

	<div <?php Hybrid\Attr\display( 'menu', $data->get( 'location' ), [
		'class' => 'menu menu--social my-4 text-center'
	] ) ?>>

		<?php wp_nav_menu( [
			'theme_location' => $data->get( 'location' ),
			'depth'          => 1,
			'container'      => '',
			'menu_id'        => '',
			'menu_class'     => 'menu__items list-none m-0 p-0',
			'link_before'    => '<span class="screen-reader-text">',
			'link_after'     => '</span>',
			'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
			'item_spacing'   => 'discard'
		] ) ?>

	</div>

<?php endif ?>
