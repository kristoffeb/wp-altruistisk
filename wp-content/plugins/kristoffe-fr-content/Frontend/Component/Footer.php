<?php

namespace Mitfoerstejob\Content\Frontend\Component;

use Mitfoerstejob\Content\Main;

class Footer {

	public function __construct() {
		add_action( THEMEDOMAIN . '-footer', [ $this, 'navigation' ] );
	}

	public function navigation() {
		Main::get_template_part( 'Partials/Global/Footer.php', [
			'logo'   => $this->get_logo_url(),
			'menu'   => $this->get_menu( 'Footer' ),
			'optin'  => $this->get_optin(),
			'social' => $this->get_menu( 'Social' ),
		] );
	}

	public function get_logo_url() {
		$logo_url = sprintf(
			'%s/assets/img/mitfoerstejob_logo_footer.svg',
			get_template_directory_uri()
		);

		return $logo_url;
	}

	public function get_menu( $menu ) {
		$menu = wp_nav_menu( [
			'menu'       => $menu,
			'theme_location' => 'footer',
			'container'  => FALSE,
			'echo'       => FALSE,
		] );

		return $menu;
	}

	public function get_optin() {
		$optin = new Optin();

		$form =	$optin->get_optin( 5 );

		return $form;
	}
}
