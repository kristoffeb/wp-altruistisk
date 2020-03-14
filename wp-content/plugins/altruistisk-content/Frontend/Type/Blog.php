<?php

namespace Altruistisk\Content\Frontend\Type;

use Altruistisk\Content\Main;

class Blog implements Page {

	/** @var Data_Holder_Factory */
	private $factory;

	public function matches_current_page() {
		return is_home() || is_archive();
	}

	public function init() {
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'grid' ] );
	}

	public function grid() {

		if ( is_home() ) {
			$title      = get_the_title( get_option( 'page_for_posts' ) );
			$shortcode  = do_shortcode( '[latest-posts number="' . get_option( 'posts_per_page' ) . '"]' );
			$categories = get_categories();

			Main::get_template_part( 'Type/Blog.php', [
				'title'      => $title,
				'categories' => $this->get_formatted_terms( $categories ),
				'grid'       => $shortcode,
				'pagination' => $this->get_pagination(),
			] );
		}

		if ( is_archive() ) {
			$title      = $this->get_archive_title( get_the_archive_title() );
			$shortcode  = do_shortcode( '[latest-posts number="' . get_option( 'posts_per_page' ) . '" category="' . get_queried_object()->slug . '"]' );
			$categories = [];

			Main::get_template_part( 'Type/Blog.php', [
				'title'      => $title,
				'categories' => [],
				'grid'       => $shortcode,
				'pagination' => $this->get_pagination(),
			] );
		}
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

	public function get_pagination() {
		$args = [
			'type'      => 'list',
			'prev_text' => __( '<', Main::TEXT_DOMAIN ),
			'next_text' => __( '>', Main::TEXT_DOMAIN ),
		];

		$list = paginate_links( $args );

		$pagination = sprintf( '<div class="pagination">%s</div>', $list );

		return $pagination;
	}

	function get_archive_title( $title ) {
	    if ( is_category() ) {
	        $title = single_cat_title( '', false );
	    } elseif ( is_tag() ) {
	        $title = single_tag_title( '', false );
	    } elseif ( is_author() ) {
	        $title = '<span class="vcard">' . get_the_author() . '</span>';
	    } elseif ( is_post_type_archive() ) {
	        $title = post_type_archive_title( '', false );
	    } elseif ( is_tax() ) {
	        $title = single_term_title( '', false );
	    }

	    return $title;
	}
}
