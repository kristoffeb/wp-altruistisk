<?php

namespace Kristoffe\Content\Frontend\Type;

use Kristoffe\Content\Admin\Type\Meta;
use Kristoffe\Content\Frontend\Component;
use Kristoffe\Content\Frontend\Data\Data_Holder_Factory;
use Kristoffe\Content\Main;

class Blog implements Page {

	/** @var Data_Holder_Factory */
	private $factory;

	public function matches_current_page() {
		return is_home();
	}

	public function init() {
		$this->factory = new Data_Holder_Factory( get_option( 'page_for_posts' ) );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'grid' ] );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'optin' ] );
	}

	public function grid() {
		$data = $this->factory->create_data_holder( Meta\Blog::PREFIX . 'description_' );
		$data['title'] = get_the_title( get_option( 'page_for_posts' ) );

		$data['pagination'] = paginate_links( [
			'prev_text' => __( '«' ),
			'next_text' => __( '»' ),
		] );

		$latest_posts = wp_get_recent_posts( [
			'offset'      => $this->get_offset(),
			'numberposts' => get_option( 'posts_per_page' ),
			'post_status' => 'publish',
		] );

		$posts = new Component\Posts( $latest_posts );
		$items = $posts->get_posts_data();

		$adspace = new Component\Adspace();
		$items[] = $adspace->get_item();

		Main::get_template_part( 'Partials/Global/Items.php', [
			'data'    => $data,
			'items'   => $items,
			'classes' => 'articles',
		] );
	}

	public function get_offset() {
		if ( get_query_var( 'paged' ) ) {
			$offset = get_option( 'posts_per_page' ) * ( get_query_var( 'paged' ) - 1 );
		} else {
			$offset = 0;
		}

		return $offset;
	}

	public function optin() {
		$data = $this->factory->create_data_holder( Meta\Blog::PREFIX . 'optin_' );

		if ( $data ) {
			$optin = new Component\Optin();

			Main::get_template_part( 'Partials/Global/Optin.php', [
				'data' => $optin->get_optin( $data['form_id'] ),
			] );
		}
	}
}
