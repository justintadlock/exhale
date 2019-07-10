<?php if ( have_posts() ) : ?>

	<div <?php Hybrid\Attr\display( 'loop', 'default', [
		'data-customize-partial-placement-context' => esc_attr( wp_json_encode( [
			'slugs' => $view->slugs()
		] ) )
	] ) ?>>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php $engine->display( 'entry', $view->slugs() ) ?>

		<?php endwhile ?>

		<?php $engine->display( 'nav/pagination', 'posts' ) ?>

	</div>

<?php endif ?>
