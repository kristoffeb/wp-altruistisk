<?php

namespace Heartland\Content\Frontend\Type;

use Heartland\Content\Admin\Type\Meta;
use Heartland\Content\Frontend\Data\Data_Holder_Factory;
use Heartland\Content\Main;

class Blog implements Page {

	/** @var Data_Holder_Factory */
	private $factory;

	public function matches_current_page() {
		return is_home();
	}

	public function init() {
		$this->factory = new Data_Holder_Factory( get_option( 'page_for_posts' ) );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'grid' ] );
	}

	public function grid() {
		$title      = get_the_title( get_option( 'page_for_posts' ) );
		$shortcode  = do_shortcode( '[latest-posts number="-1"]' );
		$categories = get_categories();


		Main::get_template_part( 'Type/Blog.php', [
			'title'      => $title,
			'categories' => $this->get_formatted_terms( $categories ),
			'grid'       => $shortcode,
		] );
	}

	public function get_formatted_terms( $categories ) {
		$terms = [];

		foreach ( $categories as $term ) {
			$terms[] = [
				'id'        => $term->term_id,
				'name'      => $term->name,
				'permalink' => get_category_link( $term->term_id ),
			];
		}

		return $terms;
	}
}
