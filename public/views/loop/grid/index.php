<?php if ( have_posts() ) : ?>

	<div <?php Hybrid\Attr\display( 'loop', 'grid', [
		'class' => sprintf(
			'loop loop--grid loop--%s',
			str_replace( '_', '-', Exhale\Template\Loop::type() )
		),
		'data-customize-partial-placement-context' => wp_json_encode( [
			'slugs' => $view->slugs()
		] )
	] ) ?>>

		<ul <?php Hybrid\Attr\display( 'grid', 'posts', [
			'class' => sprintf(
				'grid grid--posts grid--%s columns-%s max-w-%s mx-auto',
				Exhale\Template\Loop::imageSize()->orientation(),
				Exhale\Template\Loop::columns(),
				Exhale\Template\Loop::width()
			)
		] ) ?>>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php $engine->display( 'entry/grid', $view->slugs() ) ?>

			<?php endwhile ?>

		</ul>

		<?php $engine->display( 'nav/pagination', 'posts' ) ?>

	</div>

<?php endif ?>
