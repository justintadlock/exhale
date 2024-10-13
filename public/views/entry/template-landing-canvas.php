<article <?php Hybrid\Attr\display( 'entry' ) ?>>

	<div class="entry__content o-content-width flow-root">
		<?php the_content() ?>
		<?php $view = $__env ?>
		<?php $view->make( 'nav/pagination/post' )->display() ?>
	</div>

</article>
