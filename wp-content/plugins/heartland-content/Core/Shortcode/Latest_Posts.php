<?php

namespace Heartland\Content\Core\Shortcode;

use Heartland\Content\Main;

class Latest_Posts {

	const SETTINGS_PREFIX = 'falconio_insights-hub_settings_';

	public function __construct() {
		add_shortcode( 'latest-posts', [ $this, 'shortcode' ] );
	}

	public function shortcode( $atts = [], $content = NULL, $tag = '' ) {

		$atts = shortcode_atts( [
			'number' => '3'
		], $atts, $tag );

		$posts = $this->get_posts( $atts['number'] );

		ob_start();

		if ( $posts ) {
			Main::get_template_part( 'Partials/Global/Latest_Posts.php', [
				'posts' => $this->get_formatted_posts( $posts ),
			] );
		}

		$content = ob_get_clean();

		return $content;
	}

	public function get_posts( $limit ) {

		$args = [
			'posts_per_page' => $limit,
			'post_type'      => 'post',
		];

		$query = new \WP_Query( $args );

		return $query->posts;
	}

	public function get_formatted_posts( $posts ) {

		$content = [];

		foreach( $posts as $index => $post ) {

			$content[] = [
				'permalink'    => get_permalink( $post->ID ),
				'title'        => get_the_title( $post->ID ),
				'excerpt'      => get_the_excerpt( $post->ID ),
				'image'        => get_the_post_thumbnail_url( $post->ID, 'full' ),
				'category'     => $this->get_category( $post->ID ),
				'date'         => get_the_date( get_option( 'date_format' ), $post->ID ),
			];

		}

		return $content;
	}

	public function get_category( $post_id ) {
		$categories = get_the_category( $post_id );

		$category_list = '';

		foreach( $categories as $term ) {
			$category_list = sprintf(
				'<li><a href="%s">%s</a></li>',
				get_term_link( $term->term_id ),
				$term->name
			);
		}

		$category_list = sprintf( '<ul class="categories">%s</ul>', $category_list );

		return $category_list;
	}
}
