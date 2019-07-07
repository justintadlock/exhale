<?php if ( is_active_sidebar( $data->sidebar ) ) : ?>

	<aside <?php Hybrid\Attr\display( 'sidebar', $data->sidebar, [
		'class' => sprintf(
			'sidebar sidebar--footer grid columns-%s %s',
			esc_attr( Exhale\Tools\Mod::get( 'sidebar_footer_columns' ) ),
			esc_attr( Exhale\Tools\Mod::get( 'sidebar_footer_align' ) )
		)
	] ) ?>>

		<?php dynamic_sidebar( $data->sidebar ) ?>

	</aside>

<?php endif ?>
