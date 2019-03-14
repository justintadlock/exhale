		<footer class="app-footer">

			<p class="app-footer__credit">
				<?php Exhale\Tools\PoweredBy::display() ?>
			</p>

			<?php Hybrid\View\display( 'nav/menu', 'social', [ 'location' => 'social' ] ) ?>

		</footer>

</div><!-- .app -->

<?php wp_footer() ?>
</body>
</html>
