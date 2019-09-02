<li class="grid__item">

	<?php Exhale\Template\FeaturedImage::display( 'featured', [
		'class' => 'entry__media max-w-full text-center'
	] ) ?>

	<header class="entry__header text-center">
		<?php Hybrid\Post\display_title( [
			'link'  => false,
			'class' => 'entry__title m-0 mt-4 text-lg',
			'text'  => Hybrid\Post\render_permalink( [
				'class' => 'entry__permalink no-underline hover:underline focus:underline',
				'text'  => '%%s'
			] )
		] ) ?>
	</header>

</li>
