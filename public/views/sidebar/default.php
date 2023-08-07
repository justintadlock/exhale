<?php if ( is_active_sidebar( $data->get( 'sidebar' ) ) ) : ?>

	<aside <?php Hybrid\Attr\display( 'sidebar', $data->get( 'sidebar' ) ) ?>>

		<h3 class="sidebar__title screen-reader-text">
			<?php Hybrid\Theme\Sidebar\display_name( $data->get( 'sidebar' ) ) ?>
		</h3>

		<?php dynamic_sidebar( $data->get( 'sidebar' ) ) ?>

	</aside>

<?php endif ?>
