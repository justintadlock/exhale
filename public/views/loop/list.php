<?php if ( have_posts() ) : ?>

	<div <?php Hybrid\Attr\display( 'loop', 'grid', [
		'data-customize-partial-placement-context' => esc_attr( wp_json_encode( [
			'hierarchy' => $data->hierarchy
		] ) )
	] ) ?>>

		<ul class="loop__items max-w-2xl mx-auto">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php Hybrid\View\display( 'entry/list', $data->hierarchy ) ?>

			<?php endwhile ?>

		</ul>

		<?php Hybrid\View\display( 'nav/pagination', 'posts' ) ?>

	</div>

<?php endif ?>
