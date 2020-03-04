<?php

namespace Heartland\Content\Core\Shortcode;

use Heartland\Content\Main;
use Heartland\Content\Core\Taxonomy;

class Artists {

	public function __construct() {
		add_shortcode( 'artists', [ $this, 'shortcode' ] );
	}

	public function shortcode( $atts = [], $content = NULL, $tag = '' ) {

		$atts = shortcode_atts( [
			'number'  => '-1',
			'program' => 'music',
		], $atts, $tag );

		$posts = $this->get_posts( $atts['number'], $atts['program'] );

		ob_start();

		if ( $posts ) {
			Main::get_template_part( 'Partials/Global/Artists.php', [
				'posts' => $this->get_formatted_posts( $posts ),
			] );
		}

		$content = ob_get_clean();

		return $content;
	}

	public function get_posts( $limit, $category ) {

		$args = [
			'posts_per_page' => $limit,
			'post_type'      => 'artist',
			'tax_query'      => [
				[
		            'taxonomy'         => Taxonomy\Program::TAXONOMY,
		            'field'            => 'slug',
		            'terms'            => $category,
					'include_children' => FALSE,
				],
			],
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
				'image'        => get_the_post_thumbnail_url( $post->ID, 'grid-normal' ),
				// 'category'     => $this->get_category( $post->ID ),
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
