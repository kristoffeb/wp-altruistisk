<?php

namespace Kristoffe\Content\Frontend\Component;

use Kristoffe\Content\Main;

class Header {

	public function __construct() {
		add_action( THEMEDOMAIN . '-main-navigation', [ $this, 'navigation' ] );
		add_filter( 'woocommerce_add_to_cart_fragments', [ $this, 'cart_count_fragments' ], 10, 1 );
	}

	public function navigation() {
		Main::get_template_part( 'Partials/Global/Header.php', [
			'logo' => $this->get_logo_url(),
			'menu' => $this->get_menu(),
			'cart' => $this->get_cart(),
		] );
	}

	public function get_logo_url() {
		$logo_url = sprintf(
			'%s/assets/img/kristoffe_logo_%s.svg',
			get_template_directory_uri(),
			'black'
		);

		return $logo_url;
	}

	public function get_menu() {
		$menu = wp_nav_menu( [
			'menu'       => 'Header',
			'container'  => FALSE,
			'echo'       => FALSE,
		] );

		return $menu;
	}

	public function get_cart() {
		$cart = sprintf(
			'<a class="cart-contents" href="%s" title="%s">%s (%s)</a>',
			$this->get_cart_url(),
			__( 'View your shopping cart', Main::TEXT_DOMAIN ),
			$this->get_cart_count(),
			$this->get_cart_total()
		);

		return $cart;
	}

	public function get_cart_url() {
		return wc_get_cart_url();
	}

	public function get_cart_count() {
		return sprintf ( _n( '%d product', '%d products', WC()->cart->get_cart_contents_count(), Main::TEXT_DOMAIN ), WC()->cart->get_cart_contents_count() );
	}

	public function get_cart_total() {
		return WC()->cart->get_cart_total();
	}

	public function cart_count_fragments( $fragments ) {
	    $fragments['a.cart-contents'] = $this->get_cart();

	    return $fragments;
	}
}
