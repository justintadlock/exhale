<?php if ( have_posts() ) : ?>

	<div <?php Hybrid\Attr\display( 'loop', 'grid', [
		'data-customize-partial-placement-context' => esc_attr( wp_json_encode( [
			'hierarchy' => $data->hierarchy
		] ) )
	] ) ?>>

		<ul <?php Hybrid\Attr\display( 'grid', 'posts', [
			'class' => sprintf(
				'grid grid--posts grid--%s columns-%s max-w-%s mx-auto',
				esc_attr( Hybrid\App::resolve( \Exhale\Image\Size\Sizes::class )->get( Exhale\Tools\Mod::get( 'featured_image_size' ) )->type() ),
				esc_attr( Exhale\Tools\Mod::get( 'content_layout_archive_columns' ) ),
				esc_attr( Exhale\Tools\Mod::get( 'content_layout_width' ) )
			)
		] ) ?>>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php Hybrid\View\display( 'entry/grid', $data->hierarchy ) ?>

			<?php endwhile ?>

		</ul>

		<?php Hybrid\View\display( 'nav/pagination', 'posts' ) ?>

	</div>

<?php endif ?>
