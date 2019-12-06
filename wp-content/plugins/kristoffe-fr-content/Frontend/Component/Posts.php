<?php

namespace Kristoffe\Content\Frontend\Component;

use Kristoffe\Content\Main;

class Posts {

	private $posts;

	public function __construct( $posts = NULL ) {
		$this->posts = $posts;
	}

	public function get_posts_data( $excerpt = TRUE ) {
		if ( empty( $this->posts ) ) {
			return;
		}

		$items = [];

		foreach ( $this->posts as $index => $post ) {
			$post = (array) $post;

			$post_data = [
				'background_image' => $this->get_background_image( $post ),
				'subheadline'      => $this->get_subheadline( $post ),
				'title'            => $this->get_title( $post ),
				'text'             => $this->get_text( $excerpt, $post ),
				'cta'              => $this->get_cta( $post ),
			];

			$items[] = $post_data;
		}

		return $items;
	}

	public function get_background_image( $post ) {
		$image_url = get_the_post_thumbnail_url( $post['ID'], 'kristoffe-thumbnail' );

		return $image_url;
	}

	public function get_subheadline( $post ) {
		$category = wp_get_post_terms( $post['ID'], 'category', [ 'term_id', 'name' ] );
		$subheadline = $category ? $category[0]->name : '';

		return $subheadline;
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
}
