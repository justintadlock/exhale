<div class="app-content">

	<main id="main" class="app-main">

		<?php Hybrid\View\display( 'partials', 'archive-header' ) ?>

		<?php Hybrid\View\display(
			'loop',
			Exhale\Tools\Mod::get( 'content_layout' ),
			[ 'hierarchy' => $data->hierarchy ]
		) ?>

	</main>

</div>
