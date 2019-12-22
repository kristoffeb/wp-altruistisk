<?php

namespace Mitfoerstejob\Content\Frontend\Component;

use Mitfoerstejob\Content\Main;

class Header {

	public function __construct() {
		add_action( THEMEDOMAIN . '-main-navigation', [ $this, 'navigation' ] );
	}

	public function navigation() {
		Main::get_template_part( 'Partials/Global/Header.php', [
			'menu' => $this->get_menu(),
		] );
	}

	public function get_menu() {
		$menu = wp_nav_menu( [
			'menu'       => 'Header',
			'container'  => FALSE,
			'echo'       => FALSE,
		] );

		return $menu;
	}
}
