<header class="header" role="banner">

	<div class="content">

		<nav id="main-nav" role="navigation">
			<div id="logo" itemscope="" itemtype="http://schema.org/Organization">
				<a href="<?php echo pll_home_url(); ?>">
					<img src="<?php echo $logo; ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" />
				</a>
			</div>

			<div class="menu-wrap">
				<?php echo $menu; ?>
			</div>

			<div id="mini-cart">
				<?php echo $cart; ?>
			</div>

			<div class="menu-icon">
			</div>
		</nav>

	</div>

</header>
