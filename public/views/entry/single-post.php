<article <?php Hybrid\Attr\display( 'entry' ) ?>>

	<header class="entry__header mb-8 text-center">
		<?php Hybrid\Theme\Post\display_title( [ 'class' => 'entry__title md:max-w-4xl mx-8 sm:mx-auto my-0' ] ) ?>

		<div class="entry__byline max-w-2xl mx-8 sm:mx-auto">
			<?php Hybrid\Theme\Post\display_author() ?>
			<?php Hybrid\Theme\Post\display_date( [ 'before' => Exhale\sep() ] ) ?>
			<?php Hybrid\Theme\Post\display_comments_link( [ 'before' => Exhale\sep() ] ) ?>
		</div>
	</header>

	<div class="entry__content o-content-width flow-root">
		<?php the_content() ?>
		<?php $engine->display( 'nav/pagination', 'post' ) ?>
	</div>

	<footer class="entry__footer max-w-2xl mx-8 sm:mx-auto mt-8">
		<?php Hybrid\Theme\Post\display_terms( [
			// Translators: %s is the category list.
			'text'     => __( 'Posted in %s', 'exhale' ),
			'taxonomy' => 'category'
		] ) ?>
		<?php Hybrid\Theme\Post\display_terms( [
			// Translators: %s is the post tags list.
			'text'     => __( 'Tagged %s', 'exhale' ),
			'taxonomy' => 'post_tag'
		] ) ?>
	</footer>

</article>
