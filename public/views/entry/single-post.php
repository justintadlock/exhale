<article <?php Hybrid\Attr\display( 'entry' ) ?>>

	<header class="entry__header mb-8 text-center">
		<?php Hybrid\Post\display_title( [ 'class' => 'entry__title md:max-w-4xl mx-8 sm:mx-auto my-0' ] ) ?>

		<div class="entry__byline max-w-2xl mx-8 sm:mx-auto">
			<?php Hybrid\Post\display_author() ?>
			<?php Hybrid\Post\display_date( [ 'before' => Exhale\sep() ] ) ?>
			<?php Hybrid\Post\display_comments_link( [ 'before' => Exhale\sep() ] ) ?>
		</div>
	</header>

	<div class="entry__content o-content-width">
		<?php the_content() ?>
		<?php $engine->display( 'nav/pagination', 'post' ) ?>
	</div>

	<footer class="entry__footer max-w-2xl mx-8 sm:mx-auto my-8">
		<?php Hybrid\Post\display_terms( [
			// Translators: %s is the category list.
			'text'     => __( 'Posted in %s', 'exhale' ),
			'taxonomy' => 'category'
		] ) ?>
		<?php Hybrid\Post\display_terms( [
			// Translators: %s is the post tags list.
			'text'     => __( 'Tagged %s', 'exhale' ),
			'taxonomy' => 'post_tag'
		] ) ?>
	</footer>

</article>
