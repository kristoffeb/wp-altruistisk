<?php
/**
 * Displays the footer.
 *
 * @link http://codex.wordpress.org/Stepping_into_Templates#Basic_Template_Files
 * @package WordPress
 *
 */
?>
	<footer class="footer" role="content-info">

		<div class="inner-grid">
			<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
				<ul id="sidebar">
        			<?php dynamic_sidebar( 'sidebar-footer' ); ?>
				</ul>
			<?php endif; ?>
		</div>

	</footer>

	<?php wp_footer(); ?>

</body>

</html>
