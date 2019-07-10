<div class="app-content">

	<main id="main" class="app-main">

		<?php $engine->display( 'partials', 'archive-header' ) ?>

		<?php if ( have_posts() ) : ?>

			<div class="entry-list o-content-width">
				<ul class="entry-list__items">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php Hybrid\Post\display_title( [
						'tag'   => 'li',
						'class' => 'entry-list__item'
					] ) ?>

				<?php endwhile ?>

				</ul>
			</div>

			<?php $engine->display( 'nav/pagination', 'posts' ) ?>

		<?php endif ?>

	</main>

</div>
