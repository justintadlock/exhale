<li <?php Hybrid\Attr\display( 'comment' ) ?>>

	<header class="comment__meta">
		<?php Hybrid\Comment\display_parent_link( [
			// Translators: %s is the parent comment link.
			'text'   => __( 'In reply to %s', 'exhale' ),
			'depth'  => 3,
			'after'  => '<br /></div>',
			'before' => '<div class="comment__parent">' . Exhale\Tools\Svg::render( 'caret-right-solid' )
		] ) ?>

		<?php echo get_avatar( $data->comment, $data->args['avatar_size'], '', '', [ 'class' => 'comment__avatar' ] ) ?>

		<?php Hybrid\Comment\display_author( [ 'after' => '<br />' ] ) ?>
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
