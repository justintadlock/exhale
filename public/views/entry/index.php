<article <?php Hybrid\Attr\display( 'entry' ) ?>>

	<header class="entry__header o-content-width">
		<?php Hybrid\Theme\Post\display_title() ?>
	</header>

	<?php Exhale\Template\FeaturedImage::display( 'featured' ) ?>

	<div class="entry__summary o-content-width">
		<?php the_excerpt() ?>
	</div>

</article>
