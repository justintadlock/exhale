<li <?php Hybrid\Attr\display( 'comment', '', [
	'class' => 1 === $depth ? 'sm:content-box w-full max-w-full sm:max-w-2xl mx-auto p-8' : 'mt-8 max-w-full'
] ) ?>>

	<header class="comment__meta pb-4">
		<?php Hybrid\Theme\Comment\display_parent_link( [
			// Translators: %s is the parent comment link.
			'text'   => __( 'In reply to %s', 'exhale' ),
			'depth'  => 3,
			'class'  => 'comment__parent-link inline-block mb-2',
			'after'  => '<br /></div>',
			'before' => sprintf(
				'<div class="comment__parent text-sm">%s',
				Exhale\Tools\Svg::render( 'caret-right-solid' )
			)
		] ) ?>

		<?php echo get_avatar( $data->get( 'comment' ), $data->get( 'args' )['avatar_size'], '', '', [
			'class' => 'comment__avatar mr-4 rounded-full'
		] ) ?>

		<?php Hybrid\Theme\Comment\display_author_link( [
			'class' => 'comment__author-link font-700 no-underline hover:underline focus:underline',
			'after' => '<br />',
		] ) ?>

		<?php Hybrid\Theme\Comment\display_permalink( [
			'text' => Hybrid\Theme\Comment\render_date( [
				'format' => sprintf(
					// Translators: Comment date + time format.
					esc_html__( '%1$s, %2$s', 'exhale' ),
					get_option( 'date_format' ),
					get_option( 'time_format' )
				)
			] )
		] ) ?>
		<?php Hybrid\Theme\Comment\display_edit_link( [ 'before' => Exhale\sep() ] ) ?>
		<?php Hybrid\Theme\Comment\display_reply_link( [ 'before' => Exhale\sep() ] ) ?>
	</header>

	<div class="comment__content mt-4">

		<?php if ( ! Hybrid\Theme\Comment\is_approved() ) : ?>

			<p class="comment__moderation">
				<?php esc_html_e( 'Your comment is awaiting moderation.', 'exhale' ) ?>
			</p>

		<?php endif ?>

		<?php comment_text() ?>
	</div>

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>
