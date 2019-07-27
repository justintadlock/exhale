<li class="grid__item">

	<?php Exhale\Template\FeaturedImage::display( 'featured' ) ?>

	<header class="entry__header has-text-align-center">
		<?php Hybrid\Post\display_title( [
			'link'  => false,
			'class' => 'entry__title m-0',
			'text'  => Hybrid\Post\render_permalink( [
				'class' => 'entry__permalink no-underline hover:underline focus:underline',
				'text'  => '%%s'
			] )
		] ) ?>
	</header>

</li>
