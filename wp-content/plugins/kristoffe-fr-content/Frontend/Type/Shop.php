<?php

namespace Kristoffe\Content\Frontend\Type;

use Kristoffe\Content\Admin\Type\Meta;
use Kristoffe\Content\Frontend\Component;
use Kristoffe\Content\Frontend\Data\Data_Holder_Factory;
use Kristoffe\Content\Frontend\Data\Holders\Data_Holder;
use Kristoffe\Content\Main;

class Shop implements Page {

	/** @var Data_Holder_Factory */
	private $factory;

	public function matches_current_page() {
		return is_shop();
	}

	public function init() {
		$this->factory = new Data_Holder_Factory( get_the_ID() );

		add_filter( 'template_include', [ $this, 'template' ], 99 );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'hero' ] );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'products' ] );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'stores' ] );
	}

	public function template( $template ) {
		$new_template = locate_template( array( 'index.php' ) );

		if ( '' != $new_template ) {
			return $new_template;
		}

		return $template;
	}

	public function hero() {
		$post = new Component\Featured_Post( (int) pll_get_post( get_option( 'woocommerce_shop_page_id' ) ) );

		$post_data = $post->get_post_data( FALSE, FALSE, 'kristoffe-hero' );
		$post_data['subheadline'] = __( 'Our products', Main::TEXT_DOMAIN );

		Main::get_template_part( 'Partials/Global/Hero.php', [
			'hero'    => $post_data,
			'is_hero' => TRUE,
			'classes' => 'inline',
		] );
	}

	public function products() {
		$products = wp_get_recent_posts( [
			'post_type'   => 'product',
			'numberposts' => -1,
			'post_status' => 'publish',
		] );

		if ( ! empty( $products ) ) {
			$data = $this->factory->create_data_holder('');
			$products = new Component\Products( $products );

			Main::get_template_part( 'Partials/Global/Items.php', [
				'data'    => $data,
				'items'   => $products->get_products_data(),
				'classes' => 'products',
			] );
		}
	}

	public function stores() {
		$data = $this->factory->create_data_holder(
			Meta\Shop::PREFIX . 'stores_',
			Data_Holder::class,
			(int) pll_get_post( get_option( 'woocommerce_shop_page_id' ) )
		);

		if ( $data ) {
			Main::get_template_part( 'Partials/Global/Section.php', [
				'data'    => $data,
				'classes' => 'stores',
			] );
		}
	}
}
