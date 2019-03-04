<div class="app-content">

	<main id="main" class="app-main">

		<?php Hybrid\View\display( 'partials', 'archive-header' ) ?>

		<?php if ( have_posts() ) : ?>

			<ul class="entry-list">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php Hybrid\Post\display_title( [
					'tag'   => 'li',
					'class' => 'entry-list__title'
				] ) ?>

			<?php endwhile ?>

			</ul>

			<?php Hybrid\View\display( 'nav/pagination', 'posts' ) ?>

		<?php endif ?>

	</main>

</div>
