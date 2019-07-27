		<footer class="app-footer overflow-y-hidden font-secondary text-base">

			<?php $engine->display( 'sidebar', 'footer', [ 'sidebar' => 'footer' ] ) ?>

			<div class="app-footer__meta py-4 px-8 border-0 border-t border-solid">

				<?php $engine->display( 'nav/menu', 'footer', [ 'location' => 'footer' ] ) ?>

				<?php Exhale\Template\Footer::displayCredit() ?>

				<?php $engine->display( 'nav/menu', 'social', [ 'location' => 'social' ] ) ?>

			</div>

		</footer>

</div><!-- .app -->

<?php wp_footer() ?>
</body>
</html>
