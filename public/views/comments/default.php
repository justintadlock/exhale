<?php if ( post_password_required() || ( ! have_comments() && ! comments_open() && ! pings_open() ) ) {
	return;
} ?>

<section id="comments" class="comments my-8">

	<?php if ( have_comments() ) : ?>

		<h2 class="comments__title max-w-2xl mx-auto px-8"><?php comments_number() ?></h2>

		<?php Hybrid\View\display( 'nav/pagination', 'comments' ) ?>

		<ol class="comments__list list-none mb-0 p-0">

			<?php wp_list_comments( [
				'avatar_size' => 60,
				'callback'    => function( $comment, $args, $depth ) {
					Hybrid\View\display( 'comment', Hybrid\Comment\hierarchy(), compact( 'comment', 'args', 'depth' ) );
				}
			] ) ?>

		</ol>

	<?php endif ?>

	<?php if ( ! comments_open() ) : ?>

		<p class="comments__closed max-w-2xl mx-auto px-8 text-center">
			<?php esc_html_e( 'Comments are closed.', 'exhale' ) ?>
		</p>

	<?php endif ?>

	<?php comment_form() ?>

</section>
