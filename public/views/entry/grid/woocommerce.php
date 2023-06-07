<li class="grid__item">

	<?php Exhale\Template\FeaturedImage::display( 'featured', [
		'class' => 'entry__media max-w-full text-center'
	] ) ?>

	<header class="entry__header text-center">
		<?php Hybrid\Theme\Post\display_title( [
			'link'  => false,
			'class' => 'entry__title m-0 mt-4 text-lg',
			'text'  => Hybrid\Theme\Post\render_permalink( [
				'class' => 'entry__permalink no-underline hover:underline focus:underline',
				'text'  => '%%s'
			] )
		] ) ?>
		<div class="entry__byline">
			<?php woocommerce_template_loop_price() ?>
		</div>
	</header>

</li>
