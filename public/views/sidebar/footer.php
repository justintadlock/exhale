<?php if ( is_active_sidebar( $data->sidebar ) ) : ?>

	<aside <?php Hybrid\Attr\display( 'sidebar', $data->sidebar ) ?>>

		<h3 class="sidebar__title screen-reader-text">
			<?php Hybrid\Sidebar\display_name( $data->sidebar ) ?>
		</h3>

		<div <?php Hybrid\Attr\display( 'grid', "sidebar-{$data->sidebar}", [
			'class' => sprintf(
				'grid grid--sidebar-footer columns-%s %s',
				esc_attr( Exhale\Tools\Mod::get( 'sidebar_footer_columns' ) ),
				esc_attr( Exhale\Tools\Mod::get( 'sidebar_footer_align' ) )
			)
		] ) ?>>

			<?php dynamic_sidebar( $data->sidebar ) ?>

		</div>

	</aside>

<?php endif ?>
