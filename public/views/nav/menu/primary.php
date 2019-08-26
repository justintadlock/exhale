<?php if ( has_nav_menu( $data->location ) ) : ?>

	<div class="toggle toggle--menu-primary block md:hidden h-16 px-8 flex items-center">
		<button class="toggle__button flex items-center px-3 py-2 rounded-sm border-0">
			<span class="screen-reader-text"><?php esc_html_e( 'Open Menu', 'exhale' ) ?></span>
			<svg class="toggle__hamburger fill-current h-5 w-5" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
				<path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
			</svg>
			<svg class="toggle__x hidden fill-current h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
				<path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"/>
			</svg>
		</button>
	</div>

	<nav <?php Hybrid\Attr\display( 'menu', $data->location, [
		'class' => 'menu menu--primary hidden md:block w-full md:h-16 flex-grow md:flex md:items-center md:justify-end md:w-auto ml-auto md:pr-2 text-sm leading-none'
	] ) ?>>

		<h3 class="menu__title screen-reader-text">
			<?php Hybrid\Menu\display_name( $data->location ) ?>
		</h3>

		<?php wp_nav_menu( [
			'theme_location' => $data->location,
			'depth'          => 1,
			'container'      => '',
			'menu_id'        => '',
			'menu_class'     => 'menu__items list-none md:h-full m-0 p-0',
			'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
			'item_spacing'   => 'discard'
		] ) ?>

	</nav>

<?php endif ?>
