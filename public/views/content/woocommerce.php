<div <?php Hybrid\Attr\display( 'app-content', '', [
	'class' => sprintf(
		'app-content max-w-%s overflow-hidden my-%s mx-auto pt-12',
		'boxed-content' === Exhale\Tools\Mod::get( 'layout' ) ? '5xl' : 'full',
		'boxed-content' === Exhale\Tools\Mod::get( 'layout' ) ? '12' : '0'
	)
] ) ?>>

	<main id="main" class="app-main mx-auto mb-12 text-lg leading-loose">

		<?php if ( is_singular() ) : ?>

			<?php woocommerce_content() ?>

		<?php else : ?>

			<?php $view = $__env ?>

			<?php $view->make( 'partials', 'archive-header' )->display() ?>

			<?php $view->make(
				sprintf( 'loop/%s', Exhale\Template\Loop::layout()->name() ),
				[ 'slugs' => $view->slugs() ]
			)->display() ?>

		<?php endif ?>

	</main>

</div>
