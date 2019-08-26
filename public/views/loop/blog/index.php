<?php if ( have_posts() ) : ?>

	<div <?php Hybrid\Attr\display( 'loop', 'blog', [
		'class' => sprintf(
			'loop loop--blog loop--%s grid grid-col-1 grid-row-gap-8',
			str_replace( '_', '-', Exhale\Template\Loop::type() )
		),
		'data-customize-partial-placement-context' => wp_json_encode( [
			'slugs' => $view->slugs()
		] )
	] ) ?>>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php $engine->display( 'entry/blog', $view->slugs() ) ?>

		<?php endwhile ?>

		<?php $engine->display( 'nav/pagination', 'posts' ) ?>

	</div>

<?php endif ?>
