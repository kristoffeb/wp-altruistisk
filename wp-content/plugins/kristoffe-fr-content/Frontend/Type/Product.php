<?php

namespace Kristoffe\Content\Frontend\Type;

use Kristoffe\Content\Admin\Type\Meta;
use Kristoffe\Content\Frontend\Component;
use Kristoffe\Content\Frontend\Data\Data_Holder_Factory;
use Kristoffe\Content\Main;

class Product implements Page {

	/** @var Data_Holder_Factory */
	private $factory;

	public function matches_current_page() {
		return is_product();
	}

	public function init() {
		$this->factory = new Data_Holder_Factory( get_the_ID() );
		$this->wc_hooks();

		add_filter( 'template_include', [ $this, 'template' ], 99 );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'product' ] );
	}

	public function wc_hooks() {
		//add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );

		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 55 );

		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 30 );

		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 4 );

		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
		add_action( 'woocommerce_before_shop_loop_item_title', [ $this, 'loop_product_thumbnail' ], 10 );

		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		add_action( 'woocommerce_after_shop_loop_item_title', [ $this, 'loop_add_to_cart' ], 20 );

		add_filter( 'woocommerce_output_related_products_args', [ $this, 'related_products_args' ] );
	}

	public function product() {
		do_action( 'woocommerce_before_main_content' );

		while ( have_posts() ) : the_post();
			wc_get_template_part( 'content', 'single-product' );
		endwhile;

		do_action( 'woocommerce_after_main_content' );
	}

	public function loop_product_thumbnail() {
		echo '<div class="image">';
			echo woocommerce_get_product_thumbnail();
		echo '</div>';
	}

	public function loop_add_to_cart() {
		echo '<div class="button">';
			echo woocommerce_template_loop_add_to_cart();
		echo '</div>';
	}

	public function related_products_args( $args ) {
		$args['posts_per_page'] = 3;

		return $args;
	}

	public function template( $template ) {
		$new_template = locate_template( array( 'index.php' ) );

		if ( '' != $new_template ) {
			return $new_template;
		}

		return $template;
	}
}
