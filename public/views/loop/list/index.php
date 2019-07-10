<?php if ( have_posts() ) : ?>

	<div <?php Hybrid\Attr\display( 'loop', 'grid', [
		'data-customize-partial-placement-context' => esc_attr( wp_json_encode( [
			'slugs' => $view->slugs()
		] ) )
	] ) ?>>

		<ul class="loop__items max-w-2xl mx-auto">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php $engine->display( 'entry/list', $view->slugs() ) ?>

			<?php endwhile ?>

		</ul>

		<?php $engine->display( 'nav/pagination', 'posts' ) ?>

	</div>

<?php endif ?>
