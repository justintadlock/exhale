<?php $view = $__env ?>

<?php if ( have_posts() ) : ?>

	<div <?php Hybrid\Attr\display( 'loop', 'list', [
		'class' => sprintf(
			'loop loop--list loop--%s',
			str_replace( '_', '-', Exhale\Template\Loop::type() )
		),
		'data-customize-partial-placement-context' => wp_json_encode( [
			'slugs' => $view->slugs()
		] )
	] ) ?>>

		<ul class="loop__items max-w-2xl mx-auto">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php $view->make( 'entry/list', [ 'slugs' => $view->slugs() ] )->display() ?>

			<?php endwhile ?>

		</ul>

		<?php $view->make( 'nav/pagination/posts' )->display() ?>

	</div>

<?php endif ?>
