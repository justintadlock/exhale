<div class="app-content">

	<main id="main" class="app-main">

		<?php $engine->display( 'partials', 'archive-header' ) ?>

		<?php $engine->display(
			sprintf( 'loop/%s', Exhale\Tools\Mod::get( 'content_layout' ) ),
			$view->slugs()
		) ?>

	</main>

</div>
