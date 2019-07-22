<div <?php Hybrid\Attr\display( 'app-content' ) ?>>

	<main id="main" class="app-main">

		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php $engine->display( 'entry', $view->slugs() ) ?>

				<?php comments_template() ?>

			<?php endwhile ?>

		<?php endif ?>

	</main>

</div>
