<?php if ( have_posts() ) : ?>

	<div <?php Hybrid\Attr\display( 'loop', 'default', [
		'data-customize-partial-placement-context' => esc_attr( wp_json_encode( [
			'hierarchy' => $data->hierarchy
		] ) )
	] ) ?>>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php Hybrid\View\display( 'entry', $data->hierarchy ) ?>

		<?php endwhile ?>

		<?php Hybrid\View\display( 'nav/pagination', 'posts' ) ?>

	</div>

<?php endif ?>
