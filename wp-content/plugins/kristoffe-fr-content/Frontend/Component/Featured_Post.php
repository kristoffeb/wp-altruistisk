<?php

namespace Mitfoerstejob\Content\Frontend\Component;

use Mitfoerstejob\Content\Main;

class Featured_Post {

	private $post_id;
	private $post;

	public function __construct( $post_id = NULL ) {
		$this->post_id = $post_id;
	}

	public function get_post_data( $excerpt = TRUE, $show_button = TRUE, $image_size = 'full' ) {
		if ( empty( $this->post_id ) ) {
			return;
		}

		$this->post = get_post( $this->post_id );

		$post_data = [
			'title'            => $this->get_title(),
			'image'            => $this->get_image( $image_size ),
			'background_image' => $this->get_background_image(),
			'button_cta'       => $this->get_button_cta( $show_button ),
			'button_label'     => __( 'Read more', Main::TEXT_DOMAIN ),
			'subheadline'      => $this->get_subheadline(),
			'text'             => $this->get_text( $excerpt ),
		];

		return $post_data;
	}

	public static function get_array_data( $array = [] ) {

		$post_data = [
			'title'            => '',
			'image'            => '',
			'background_image' => '',
			'button_cta'       => '',
			'button_label'     => '',
			'subheadline'      => '',
			'text'             => '',
		];

		foreach ( $array as $index => $value ) {
			$post_data[ $index ] = $value;
		}

		return $post_data;
	}

	public function get_title() {
		return $this->post->post_title;
	}

	public function get_image( $image_size ) {
		return get_the_post_thumbnail_url( $this->post->ID, $image_size );
	}

	public function get_background_image() {
		return;
	}

	public function get_button_cta( $show_button ) {
		if ( ! $show_button ) {
			return;
		}

		return $this->post->ID;
	}

	public function get_subheadline() {
		$category = wp_get_post_terms( $this->post->ID, 'category', [ 'term_id', 'name' ] );
		$subheadline = $category ? $category[0]->name : '';

		return $subheadline;
	}

	public function get_text( $excerpt ) {
		if ( $excerpt ) {
			$text = apply_filters( 'the_excerpt', get_post_field( 'post_excerpt', $this->post->ID ) );
		} else {
			$text = apply_filters( 'the_content', $this->post->post_content );
		}

		return $text;
	}
}
