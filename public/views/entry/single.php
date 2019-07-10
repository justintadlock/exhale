<article <?php Hybrid\Attr\display( 'entry' ) ?>>

	<header class="entry__header o-content-width">
		<?php Hybrid\Post\display_title() ?>
	</header>

	<div class="entry__content o-content-width">
		<?php the_content() ?>
		<?php $engine->display( 'nav/pagination', 'post' ) ?>
	</div>

</article>
