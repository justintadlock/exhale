<?php if ( has_nav_menu( $data->get( 'location' ) ) ) : ?>

	<nav <?php Hybrid\Attr\display( 'menu', $data->get( 'location' ) ) ?>>

		<h3 class="menu__title screen-reader-text">
			<?php Hybrid\Theme\Menu\display_name( $data->get( 'location' ) ) ?>
		</h3>

		<?php wp_nav_menu( [
			'theme_location' => $data->get( 'location' ),
			'container'      => '',
			'menu_id'        => '',
			'menu_class'     => 'menu__items',
			'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
			'item_spacing'   => 'discard'
		] ) ?>

	</nav>

<?php endif ?>
