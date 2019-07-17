<div class="app-content">

	<main id="main" class="app-main">

		<?php $error->setup() ?>

		<div class="entry entry--error">

			<header class="entry__header o-content-width">
				<h1 class="entry__title"><?php $error->displayTitle() ?></h1>
			</header>

			<div class="entry__content o-content-width">
				<?php $error->displayContent() ?>
			</div>

		</div>

		<?php $error->reset() ?>

	</main>

</div>
