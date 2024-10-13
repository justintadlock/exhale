<div <?php Hybrid\Attr\display( 'app-content', '', [
	'class' => sprintf(
		'app-content max-w-%s overflow-hidden my-%s mx-auto pt-12',
		'boxed-content' === Exhale\Tools\Mod::get( 'layout' ) ? '5xl' : 'full',
		'boxed-content' === Exhale\Tools\Mod::get( 'layout' ) ? '12' : '0'
	)
] ) ?>>

	<main id="main" class="app-main mx-auto mb-12 text-lg leading-loose">

		<?php $view = $__env ?>

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php $view->make( 'entry', [ 'slugs' => $view->slugs() ] )->display() ?>

				<?php comments_template() ?>

			<?php endwhile ?>

		<?php endif ?>

	</main>

</div>
