<article <?php Hybrid\Attr\display( 'entry' ) ?>>

	<header class="entry__header">
		<?php Hybrid\Post\display_title() ?>

		<div class="entry__byline">
			<?php Hybrid\Post\display_author() ?>
			<?php Hybrid\Post\display_date( [ 'before' => Exhale\sep() ] ) ?>
			<?php Hybrid\Post\display_comments_link( [ 'before' => Exhale\sep() ] ) ?>
		</div>
	</header>

	<div class="entry__content">
		<?php the_content() ?>
		<?php Hybrid\View\display( 'nav/pagination', 'post' ) ?>
	</div>

	<footer class="entry__footer">
		<?php Hybrid\Post\display_terms( [
			// Translators: %s is the category list.
			'text'     => __( 'Posted in %s', 'exhale' ),
			'taxonomy' => 'category'
		] ) ?>
		<?php Hybrid\Post\display_terms( [
			// Translators: %s is the post tags list.
			'text'     => __( 'Tagged %s', 'exhale' ),
			'taxonomy' => 'post_tag',
			'before'   => '<br />'
		] ) ?>
	</footer>

</article>
