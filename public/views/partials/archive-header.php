<?php if ( ! is_front_page() ) : ?>

	<div class="archive-header o-content-width mb-8 text-center">

		<h1 class="archive-header__title mb-2"><?php the_archive_title() ?></h1>

		<?php if ( ! is_paged() && get_the_archive_description() ) : ?>

			<div class="archive-header__description">
				<?php the_archive_description() ?>
			</div>

		<?php endif ?>

	</div>

<?php endif ?>
