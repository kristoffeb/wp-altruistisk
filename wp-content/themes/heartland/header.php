<?php
/**
 * Displays the header HTML.
 *
 * @link http://codex.wordpress.org/Stepping_into_Templates#Basic_Template_Files
 * @package WordPress
 *
 */

namespace Heartland;
?>

<!DOCTYPE html>
<!--[if IE 8]><html class="lt-ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 8]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">

	<title><?php echo is_front_page() ? get_bloginfo( 'name' ) : wp_title( '- ' . get_bloginfo( 'name' ), false, 'right' ); ?></title>

	<?php wp_head(); ?>

	<!--[if lt IE 9]>
		<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.min.js"></script>
	<![endif]-->

</head>

<body <?php body_class(); echo apply_filters( THEMEDOMAIN . '-body_attributes', '', 10 ); ?>>

	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', THEMEDOMAIN ); ?></a>

	<?php do_action( THEMEDOMAIN . '-before_header' ); ?>

	<header class="header" role="banner">

		<div class="inner-grid">

			<?php do_action( THEMEDOMAIN . '-before_main_nav' ); ?>

				<div id="logo" itemscope="" itemtype="http://schema.org/Organization">
					<a href="<?php echo get_home_url(); ?>">
						<?php the_custom_header_markup(); ?>

						<span class="description">
							<?php bloginfo( 'description' ); ?>
						</span>
					</a>
				</div>

				<nav id="main-nav" role="navigation">
					<?php
						wp_nav_menu( [
							'theme_location'  => 'main-nav',
						] );
					?>
				</nav>

			<?php do_action( THEMEDOMAIN . '-after_main_nav' ); ?>

		</div>

	</header> <!-- #header -->

	<?php do_action( THEMEDOMAIN . '-after_header' ); ?>
