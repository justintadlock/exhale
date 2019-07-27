<?php if ( have_posts() ) : ?>

	<div <?php Hybrid\Attr\display( 'loop', 'grid', [
		'class' => sprintf(
			'loop loop--grid loop--%s px-8',
			str_replace( '_', '-', Exhale\Template\Loop::type() )
		),
		'data-customize-partial-placement-context' => wp_json_encode( [
			'slugs' => $view->slugs()
		] )
	] ) ?>>

		<div class="text-secondary">
			<?php woocommerce_result_count() ?>
			<?php woocommerce_catalog_ordering() ?>
		</div>

		<ul <?php Hybrid\Attr\display( 'grid', 'posts', [
			'class' => sprintf(
				'clear grid grid--posts grid-col-%s sm:grid-col-%s md:grid-col-%s grid-gap-8 list-none max-w-%s mx-auto mb-8 p-0',
				'landscape' === Exhale\Template\Loop::imageSize()->orientation() ? 1 : 2,
				3 <= Exhale\Template\Loop::columns() ? 3 : 2,
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
