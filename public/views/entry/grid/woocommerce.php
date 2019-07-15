<li class="grid__item">

	<?php Exhale\Template\FeaturedImage::display( 'featured' ) ?>

	<header class="entry__header">
		<?php Hybrid\Post\display_title() ?>
		<div class="entry__byline">
			<?php woocommerce_template_loop_price() ?>
		</div>
	</header>

</li>
