<?php if ( $active_sidebars = Exhale\Template\Footer::activeSidebars() ) : ?>

	<aside <?php Hybrid\Attr\display( 'sidebar', $sidebar ) ?>>

		<ul <?php Hybrid\Attr\display( 'grid', 'sidebar-footer', [
			'class' => sprintf(
				'grid grid--sidebar-footer columns-%s max-w-%s mx-auto',
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
