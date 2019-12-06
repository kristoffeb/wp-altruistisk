<?php
use Kristoffe\Content\Main;
?>

<footer class="footer" role="content-info">

	<div class="grid">
		<div class="logo">
			<a href="<?php echo get_home_url(); ?>">
				<img src="<?php echo $logo; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" />
			</a>
		</div>

		<nav id="footer-nav" role="navigation">
			<div class="menu-wrap">
				<?php echo $menu; ?>
			</div>

			<div class="subfooter">
				<div class="optin">
					<div class="title">
						<?php _e( 'Newsletter', Main::TEXT_DOMAIN ); ?>
					</div>
					<?php echo $optin; ?>
				</div>

				<div class="social">
					<div class="title">
						<?php _e( 'Follow us', Main::TEXT_DOMAIN ); ?>
					</div>
					<?php echo $social; ?>
				</div>
			</div>
		</nav>
	</div>

</footer>
