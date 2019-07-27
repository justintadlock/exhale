<li <?php Hybrid\Attr\display( 'comment', '', [
	'class' => 1 === $depth ? 'max-w-2xl mx-auto mb-0 sm:mb-8 pt-8 pr-8 pl-8' : ''
] ) ?>>

	<header class="comment__meta mb-4 pb-4">
		<?php Hybrid\Comment\display_parent_link( [
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

		<?php echo get_avatar( $data->comment, $data->args['avatar_size'], '', '', [
			'class' => 'comment__avatar mr-4 rounded-full'
		] ) ?>

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
		<?php Hybrid\Comment\display_edit_link( [ 'before' => Exhale\sep() ] ) ?>
		<?php Hybrid\Comment\display_reply_link( [ 'before' => Exhale\sep() ] ) ?>
	</header>

	<div class="comment__content">

		<?php if ( ! Hybrid\Comment\is_approved() ) : ?>

			<p class="comment__moderation">
				<?php esc_html_e( 'Your comment is awaiting moderation.', 'exhale' ) ?>
			</p>

		<?php endif ?>

		<?php comment_text() ?>
	</div>

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>
