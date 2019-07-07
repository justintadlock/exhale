		<footer class="app-footer">

			<?php Hybrid\View\display( 'sidebar', 'footer', [ 'sidebar' => 'footer' ] ) ?>

			<?php Hybrid\View\display( 'nav/menu', 'footer', [ 'location' => 'footer' ] ) ?>

			<?php Exhale\Template\Footer::displayCredit() ?>

			<?php Hybrid\View\display( 'nav/menu', 'social', [ 'location' => 'social' ] ) ?>

		</footer>

</div><!-- .app -->

<?php wp_footer() ?>
</body>
</html>
