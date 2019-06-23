<article <?php Hybrid\Attr\display( 'entry' ) ?>>

	<div class="entry__content o-content-width">
		<?php the_content() ?>
		<?php Hybrid\View\display( 'nav/pagination', 'post' ) ?>
	</div>

</article>
