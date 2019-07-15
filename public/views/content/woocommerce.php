<div class="app-content">

	<main id="main" class="app-main">

		<?php if ( is_singular() ) : ?>

			<?php woocommerce_content() ?>

		<?php else : ?>

			<?php $engine->display( 'partials', 'archive-header' ) ?>

			<?php $engine->display(
				sprintf( 'loop/%s', Exhale\Template\Loop::layout()->name() ),
				$view->slugs()
			) ?>

		<?php endif ?>

	</main>

</div>
