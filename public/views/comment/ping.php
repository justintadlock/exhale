<li <?php Hybrid\Attr\display( 'comment' ) ?>>

	<div class="comment__meta">
		<?php Hybrid\Comment\display_author( [ 'after' => '<br />' ] ) ?>
		<?php Hybrid\Comment\display_permalink( [
			'text' => Hybrid\Comment\render_date( [
				'format' => sprintf(
					// Translators: Comment date + time format.
					esc_html__( '%1$s, %2$s' ),
					get_option( 'date_format' ),
					get_option( 'time_format' )
				)
			] )
		] ) ?>
		<?php Hybrid\Comment\display_edit_link( [ 'before' => Exhale\sep() ] ) ?>
	</div>

	<div class="comment__content">

		<?php if ( ! Hybrid\Comment\is_approved() ) : ?>

			<p class="comment__moderation">
				<?php esc_html_e( 'Your comment is awaiting moderation.' ) ?>
			</p>

		<?php endif ?>

		<?php comment_text() ?>
	</div>

<?php /* No closing </li> is needed.  WordPress will know where to add it. */ ?>
