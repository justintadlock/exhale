<li <?php Hybrid\Attr\display( 'comment', '', [
	'class' => 1 === $depth ? 'sm:content-box w-full max-w-full sm:max-w-2xl mx-auto p-8' : 'mt-8 max-w-full'
] ) ?>>

	<header class="comment__meta pb-4">
		<?php Hybrid\Comment\display_author_link( [
			'class' => 'comment__author-link font-700 no-underline hover:underline focus:underline',
			'after' => '<br />',
		] ) ?>

		<?php Hybrid\Comment\display_permalink( [
			'text' => Hybrid\Comment\render_date( [
				'format' => sprintf(
					// Translators: Comment date + time format.
					esc_html__( '%1$s, %2$s', 'exhale' ),
					get_option( 'date_format' ),
					get_option( 'time_format' )
				)
			] )
		] ) ?>
		<?php Hybrid\Comment\display_edit_link( [ 'before' => ' <span class="sep mx-2">&middot;</span> ' ] ) ?>
	</header>

	<div class="comment__content mt-4">

		<?php if ( ! Hybrid\Comment\is_approved() ) : ?>

			<p class="comment__moderation">
				<?php esc_html_e( 'Your comment is awaiting moderation.', 'exhale' ) ?>
			</p>

		<?php endif ?>

		<?php comment_text() ?>
	</div>

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>
