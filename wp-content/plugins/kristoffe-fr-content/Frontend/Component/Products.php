<?php

namespace Mitfoerstejob\Content\Frontend\Component;

use Mitfoerstejob\Content\Main;

class Products {

	private $products;

	public function __construct( $products = NULL ) {
		$this->products = $products;
	}

	public function get_products_data( $excerpt = TRUE ) {
		if ( empty( $this->products ) ) {
			return;
		}

		$items = [];

		foreach ( $this->products as $index => $product ) {

			$product_obj = new \WC_Product( $product['ID'] );

			$product_data = [
				'id'       => $product['ID'],
				'image'    => $this->get_background_image( $product ),
				'title'    => $this->get_title( $product ),
				'text'     => $this->get_text( $excerpt, $product ),
				'cta'      => $this->get_cta( $product ),
				'price'    => $this->get_price( $product_obj ),
				'button'   => $this->get_button_id( $product ),
				'in_stock' => $this->get_in_stock( $product_obj ),
			];

			$items[] = $product_data;
		}

		return $items;
	}

	public function get_background_image( $post ) {
		$image_url = get_the_post_thumbnail_url( $post['ID'], 'mitfoerstejob-item' );

		return $image_url;
	}

	public function get_title( $post ) {
		return $post['post_title'];
	}

	public function get_text( $excerpt, $post ) {
		if ( $excerpt ) {
			$text = apply_filters( 'the_excerpt', get_post_field( 'post_excerpt', $post['ID'] ) );
		} else {
			$text = $post['post_content'];
		}

		return $text;
	}

	public function get_cta( $post ) {
		return get_permalink( $post['ID'] );
	}

	public function get_price( $product_obj ) {
		return $product_obj->get_price_html();
	}

	public function get_button_id( $post ) {
		return $post['ID'];
	}

	public function get_in_stock( $product_obj ) {
		return $product_obj->is_in_stock();
	}
}
