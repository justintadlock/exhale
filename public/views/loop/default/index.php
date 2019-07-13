<?php if ( have_posts() ) : ?>

	<div <?php Hybrid\Attr\display( 'loop', 'default', [
		'class' => sprintf(
			'loop loop--default loop--%s',
			Exhale\Template\Loop::type()
		),
		'data-customize-partial-placement-context' => wp_json_encode( [
			'slugs' => $view->slugs()
		] )
	] ) ?>>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php $engine->display( 'entry', $view->slugs() ) ?>

		<?php endwhile ?>

		<?php $engine->display( 'nav/pagination', 'posts' ) ?>

	</div>

<?php endif ?>
