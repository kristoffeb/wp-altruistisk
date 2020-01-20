<?php

namespace Heartland\Content\Frontend\Component;

use Heartland\Content\Main;

class Categories {

	private $categories_id;

	public function __construct( $categories_id = NULL ) {
		$this->categories_id = $categories_id;
	}

	public function get_categories_data( $taxonomy ) {
		if ( empty( $this->categories_id ) ) {
			return;
		}

		$items = [];

		foreach ( $this->categories_id as $index => $category_id ) {
			$category = get_term_by( 'term_taxonomy_id', $category_id, $taxonomy );
			$category_image_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', TRUE );

			$category_data = [
				'background_image' => wp_get_attachment_url( $category_image_id ),
				'title'            => $category->name,
				'cta'              => get_term_link( $category->term_id, $taxonomy ),
			];

			$items[] = $category_data;
		}

		return $items;
	}
}
