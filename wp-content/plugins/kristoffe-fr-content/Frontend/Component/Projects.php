<?php

namespace Kristoffe\Content\Frontend\Component;

use Kristoffe\Content\Admin\Helpers\Constants;
use Kristoffe\Content\Admin\Type\Meta;
use Kristoffe\Content\Main;

class Projects {

	private $projects;

	public function __construct( $projects = NULL ) {
		$this->projects = $projects->posts;
	}

	public function get_projects_data( $excerpt = TRUE ) {
		if ( empty( $this->projects ) ) {
			return;
		}

		$items = [];

		foreach ( $this->projects as $index => $project ) {
			$project_data = [
				'thumbnail'   => $this->get_thumbnail( $project ),
				'subheadline' => $this->get_subheadline( $project ),
				'title'       => $this->get_title( $project ),
				'text'        => $this->get_text( $excerpt, $project ),
				'cta'         => $this->get_cta( $project ),
			];

			$items[] = $project_data;
		}

		return $items;
	}

	public function get_thumbnail( $post ) {
		$image_url = get_the_post_thumbnail_url( $post->ID, 'full' );

		return $image_url;
	}

	public function get_subheadline( $post ) {
		return get_post_meta( $post->ID, Constants::FORM_PREFIX . Meta\Project::PREFIX . 'info_subheadline', TRUE );
	}

	public function get_title( $post ) {
		return $post->post_title;
	}

	public function get_text( $excerpt, $post ) {
		if ( $excerpt ) {
			$text = apply_filters( 'the_excerpt', get_post_field( 'post_excerpt', $post->ID ) );
		} else {
			$text = $post->post_content;
		}

		return $text;
	}

	public function get_cta( $post ) {
		return get_permalink( $post->ID );
	}
}
