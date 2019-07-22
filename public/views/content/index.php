<div <?php Hybrid\Attr\display( 'app-content' ) ?>>

	<main id="main" class="app-main">

		<?php $engine->display( 'partials', 'archive-header' ) ?>

		<?php $engine->display(
			sprintf( 'loop/%s', Exhale\Template\Loop::layout()->name() ),
			$view->slugs()
		) ?>

	</main>

</div>
