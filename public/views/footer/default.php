		<footer class="app-footer">

			<?php $engine->display( 'sidebar', 'footer', [ 'sidebar' => 'footer' ] ) ?>

			<?php $engine->display( 'nav/menu', 'footer', [ 'location' => 'footer' ] ) ?>

			<?php Exhale\Template\Footer::displayCredit() ?>

			<?php $engine->display( 'nav/menu', 'social', [ 'location' => 'social' ] ) ?>

		</footer>

</div><!-- .app -->

<?php wp_footer() ?>
</body>
</html>
