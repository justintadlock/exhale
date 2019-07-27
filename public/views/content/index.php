<div <?php Hybrid\Attr\display( 'app-content', '', [
	'class' => sprintf(
		'app-content max-w-%s overflow-hidden my-%s mx-auto pt-12',
		'boxed-content' === Exhale\Tools\Mod::get( 'layout' ) ? '5xl' : 'full',
		'boxed-content' === Exhale\Tools\Mod::get( 'layout' ) ? '12' : '0'
	)
] ) ?>>

	<main id="main" class="app-main mx-auto mb-12 text-lg leading-loose">

		<?php $engine->display( 'partials', 'archive-header' ) ?>

		<?php $engine->display(
			sprintf( 'loop/%s', Exhale\Template\Loop::layout()->name() ),
			$view->slugs()
		) ?>

	</main>

</div>
