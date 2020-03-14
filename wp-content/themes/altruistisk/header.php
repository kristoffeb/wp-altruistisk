<?php
/**
 * Displays the header HTML.
 *
 * @link http://codex.wordpress.org/Stepping_into_Templates#Basic_Template_Files
 * @package WordPress
 *
 */

namespace Altruistisk;
?>

<!DOCTYPE html>
<!--[if IE 8]><html class="lt-ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 8]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">

	<title><?php echo is_front_page() ? get_bloginfo( 'name' ) : wp_title( '- ' . get_bloginfo( 'name' ), false, 'right' ); ?></title>

	<?php wp_head(); ?>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-136247204-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-136247204-1');
	</script>

	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-T4XT6KZ');</script>
	<!-- End Google Tag Manager -->

	<!-- Facebook Pixel Code -->
	<script>
	  !function(f,b,e,v,n,t,s)
	  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	  n.queue=[];t=b.createElement(e);t.async=!0;
	  t.src=v;s=b.getElementsByTagName(e)[0];
	  s.parentNode.insertBefore(t,s)}(window, document,'script',
	  'https://connect.facebook.net/en_US/fbevents.js');
	  fbq('init', '1459211584103762');
	  fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	  src="https://www.facebook.com/tr?id=1459211584103762&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Facebook Pixel Code -->

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

				<div class="back-menu">
                    <a><?php _e( 'Back', THEMEDOMAIN ) ?></a>
                </div>

				<div class="mobile-menu">
					<button class="burger">
						<?php _e( 'Menu', THEMEDOMAIN ); ?>
					</button>
				</div>

			<?php do_action( THEMEDOMAIN . '-after_main_nav' ); ?>

		</div>

	</header> <!-- #header -->

	<?php do_action( THEMEDOMAIN . '-after_header' ); ?>
