<?php if ( has_nav_menu( $data->get( 'location' ) ) ) : ?>

	<nav <?php Hybrid\Attr\display( 'menu', $data->get( 'location' ), [
		'class' => 'menu menu--footer my-4 text-center'
	] ) ?>>

		<h3 class="menu__title screen-reader-text">
			<?php Hybrid\Theme\Menu\display_name( $data->get( 'location' ) ) ?>
		</h3>

		<?php wp_nav_menu( [
			'theme_location' => $data->get( 'location' ),
			'depth'          => 1,
			'container'      => '',
			'menu_id'        => '',
			'menu_class'     => 'menu__items list-none m-0 p-0',
			'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
			'item_spacing'   => 'discard'
		] ) ?>

	</nav>

<?php endif ?>
