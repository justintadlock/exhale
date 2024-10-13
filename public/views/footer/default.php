		<footer <?php Hybrid\Attr\display( 'app-footer', '', [
			'class' => 'app-footer overflow-y-hidden font-secondary text-base'
		] ) ?>>

			<?php $view = $__env ?>

			<?php $view->make( 'sidebar/footer', [ 'sidebar' => 'footer' ] )->display() ?>

			<div class="app-footer__meta py-4 px-8 border-0 border-t border-solid">

				<?php $view->make( 'nav/menu/footer', [ 'location' => 'footer' ] )->display() ?>

				<?php Exhale\Template\Footer::displayCredit() ?>

				<?php $view->make( 'nav/menu/social', [ 'location' => 'social' ] )->display() ?>

			</div>

		</footer>

</div><!-- .app -->

<?php wp_footer() ?>
</body>
</html>
