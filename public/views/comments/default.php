<?php if ( post_password_required() || ( ! have_comments() && ! comments_open() && ! pings_open() ) ) {
	return;
} ?>

<?php
// As this template is not loaded via View,
// So will have to manually fetch the view object.
// $view = $__env;

$view = Hybrid\App::resolve( 'theme.view' );
?>

<section id="comments" class="comments my-8">

	<?php if ( have_comments() ) : ?>

		<h2 class="comments__title max-w-2xl mx-auto px-8 sm:px-0"><?php comments_number() ?></h2>

		<?php $view->make( 'nav/pagination/comments' )->display() ?>

		<ol class="comments__list sm:grid grid-row-gap-8 list-none m-0 p-0">

			<?php wp_list_comments( [
				'avatar_size' => 60,
				'callback'    => function( $comment, $args, $depth ) use ( $view ) {
					$view->make( 'comment', [ 'slugs' => Hybrid\Theme\Comment\hierarchy() ], compact( 'comment', 'args', 'depth' ) )->display();
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
