<article <?php Hybrid\Attr\display( 'entry' ) ?>>

	<header class="entry__header text-center">
		<?php Hybrid\Post\display_title( [
			'link'  => false,
			'class' => 'entry__title md:max-w-4xl mx-8 sm:mx-auto my-0',
			'text'  => Hybrid\Post\render_permalink( [
				'class' => 'entry__permalink no-underline hover:underline focus:underline',
				'text'  => '%%s'
			] )
		] ) ?>

		<div class="entry__byline max-w-2xl mx-8 sm:mx-auto">
			<?php Hybrid\Post\display_author() ?>
			<?php Hybrid\Post\display_date( [ 'before' => Exhale\sep() ] ) ?>
			<?php Hybrid\Post\display_comments_link( [ 'before' => Exhale\sep() ] ) ?>
		</div>
	</header>

	<?php Exhale\Template\FeaturedImage::display( 'featured', [
		'class' => 'entry__media max-w-full mt-4 text-center'
	] ) ?>

	<div class="entry__summary o-content-width mt-4">
		<?php the_excerpt() ?>
	</div>

</article>
