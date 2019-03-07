<article <?php Hybrid\Attr\display( 'entry' ) ?>>

	<header class="entry__header">
		<?php Hybrid\Post\display_title() ?>

		<div class="entry__byline">
			<?php Hybrid\Post\display_author() ?>
			<?php Hybrid\Post\display_date( [ 'before' => Exhale\sep() ] ) ?>
			<?php Hybrid\Post\display_comments_link( [ 'before' => Exhale\sep() ] ) ?>
		</div>
	</header>

	<?php the_post_thumbnail( 'exhale-wide', [ 'class' => 'entry__image alignwide' ] ) ?>



	<div class="entry__summary">
		<?php the_excerpt() ?>
	</div>

</article>
