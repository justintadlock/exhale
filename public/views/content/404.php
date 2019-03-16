<div class="app-content">

	<main id="main" class="app-main">

		<div class="entry entry--error">

			<?php $error = ( new Exhale\Template\ErrorPage() )->setup() ?>

			<header class="entry__header">
				<h1 class="entry__title"><?php $error->displayTitle() ?></h1>
			</header>

			<div class="entry__content">
				<?php $error->displayContent() ?>
			</div>

			<?php $error->reset() ?>
		</div>

	</main>

</div>
