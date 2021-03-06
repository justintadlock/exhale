<article <?php Hybrid\Attr\display( 'entry' ) ?>>

	<header class="entry__header mb-8 text-center">
		<?php Hybrid\Post\display_title( [ 'class' => 'entry__title md:max-w-4xl mx-8 sm:mx-auto my-0' ] ) ?>
	</header>

	<div class="entry__content o-content-width flow-root">
		<?php the_content() ?>
		<?php $engine->display( 'nav/pagination', 'post' ) ?>
	</div>

</article>
