<?php if ( $active_sidebars = Exhale\Template\Footer::activeSidebars() ) : ?>

	<aside <?php Hybrid\Attr\display( 'sidebar', $sidebar, [
		'class' => 'sidebar sidebar--footer pt-8 px-8 border-0 border-t border-solid'
	]
	) ?>>

		<ul <?php Hybrid\Attr\display( 'grid', 'sidebar-footer', [
			'class' => sprintf(
				'grid grid--sidebar-footer grid-col-1 sm:grid-col-%s md:grid-col-%s grid-col-gap-8 list-none max-w-%s my-0 mx-auto p-0',
				2 <= count( $active_sidebars ) ? 2 : 1,
				esc_attr( count( $active_sidebars ) ),
				esc_attr( Exhale\Tools\Mod::get( 'sidebar_footer_width' ) )
			)
		] ) ?>>

			<?php foreach ( range( 1, 4 ) as $id ) : ?>

				<?php if ( in_array( "{$sidebar}-{$id}", $active_sidebars ) ) : ?>

					<li <?php Hybrid\Attr\display( 'sidebar', "{$sidebar}-{$id}", [
						'class' => sprintf(
							'sidebar sidebar--footer-%s grid__item',
							esc_attr( $id )
						)
					] ) ?>>
						<?php dynamic_sidebar( "{$sidebar}-{$id}" ) ?>
					</li>

				<?php endif ?>

			<?php endforeach ?>

		</ul>

	</aside>

<?php endif ?>
