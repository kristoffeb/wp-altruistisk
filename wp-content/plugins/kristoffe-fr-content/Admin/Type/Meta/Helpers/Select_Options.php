<?php

namespace Mitfoerstejob\Content\Admin\Type\Meta\Helpers;


class Select_Options {

	public static function get_categories( $slug ) {
		$options = [];

		$terms = get_terms( [
			'taxonomy'   => $slug,
			'hide_empty' => FALSE,
		] );

		foreach ( $terms as $index => $term ) {
			$options[ $term->term_id ] = $term->name;
		}

		return $options;
	}
}
