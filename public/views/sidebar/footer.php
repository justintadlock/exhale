<?php if ( is_active_sidebar( $data->sidebar ) ) : ?>

	<aside <?php Hybrid\Attr\display( 'sidebar', $data->sidebar ) ?>>

		<h3 class="sidebar__title screen-reader-text">
			<?php Hybrid\Sidebar\display_name( $data->sidebar ) ?>
		</h3>

		<div <?php Hybrid\Attr\display( 'flex-grid', "sidebar-{$data->sidebar}", [
			'class' => sprintf(
				'flex-grid flex-grid--sidebar-footer columns-%s max-w-%s mx-auto',
				esc_attr( Exhale\Tools\Mod::get( 'sidebar_footer_columns' ) ),
				esc_attr( Exhale\Tools\Mod::get( 'sidebar_footer_width' ) )
			)
		] ) ?>>

			<?php dynamic_sidebar( $data->sidebar ) ?>

		</div>

	</aside>

<?php endif ?>
