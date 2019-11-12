<?php

namespace Kristoffe\Content\Frontend\Type;

use Kristoffe\Content\Admin\Type\Meta;
use Kristoffe\Content\Frontend\Component;
use Kristoffe\Content\Frontend\Data\Data_Holder_Factory;
use Kristoffe\Content\Main;

class Checkout implements Page {

	/** @var Data_Holder_Factory */
	private $factory;

	public function matches_current_page() {
		return is_checkout();
	}

	public function init() {
		$this->factory = new Data_Holder_Factory( get_the_ID() );
		$this->wc_hooks();

		add_filter( 'template_include', [ $this, 'template' ], 99 );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'checkout' ] );
	}

	public function wc_hooks() {
		//add_action( 'woocommerce_before_cart_table', [ $this, 'cart_title' ] );
	}

	public function checkout() {
		echo do_shortcode( get_post_field( 'post_content', get_the_ID() ) )	;
	}

	public function cart_title() {
		echo '<div class="title">';
			echo sprintf( '<h1>%s</h1>', __( 'My Cart', Main::TEXT_DOMAIN ) );
		echo '</div>';
	}

	public function template( $template ) {
		$new_template = locate_template( array( 'index.php' ) );

		if ( '' != $new_template ) {
			return $new_template;
		}

		return $template;
	}
}
