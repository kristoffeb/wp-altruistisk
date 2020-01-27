<?php

namespace Heartland\Content\Core\Shortcode;

use Heartland\Content\Main;
use Heartland\Content\Core\Taxonomy;

class Categories {

	public function __construct() {
		add_shortcode( 'categories', [ $this, 'shortcode' ] );
	}

	public function shortcode( $atts = [], $content = NULL, $tag = '' ) {

		$atts = shortcode_atts( [], $atts, $tag );

		$terms = $this->get_categories();

		ob_start();

		if ( $terms ) {
			Main::get_template_part( 'Partials/Global/Categories.php', [
				'categories' => $this->get_formatted_terms( $terms ),
			] );
		}

		$content = ob_get_clean();

		return $content;
	}

	public function get_categories() {
		$terms = get_terms( [
			'taxonomy'   => Taxonomy\Program::TAXONOMY,
			'hide_empty' => false,
			'orderby'    => 'date',
		] );

		return $terms;
	}

	public function get_formatted_terms( $terms ) {
		$sorted = [];

		foreach( $terms as $term ) {
			$sorted[] = [
				'term_id' => $term->term_id,
				'name'    => $term->name,
				'slug'    => $term->slug,
			];
		}

		asort( $sorted );

		return $sorted;
	}
}
