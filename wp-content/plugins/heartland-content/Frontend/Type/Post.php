<?php

namespace Heartland\Content\Frontend\Type;

use Heartland\Content\Admin\Type\Meta;
use Heartland\Content\Frontend\Component;
use Heartland\Content\Frontend\Data\Data_Holder_Factory;
use Heartland\Content\Frontend\Data\Holders\Data_Holder;
use Heartland\Content\Main;

class Post implements Page {

	/** @var Data_Holder_Factory */
	private $factory;

	public function matches_current_page() {
		return ( is_single() && ! is_product() );
	}

	public function init() {
		$this->factory = new Data_Holder_Factory( get_the_ID() );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'post' ] );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'optin' ] );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'recipes' ] );
	}

	public function post() {
		Main::get_template_part( 'Type/Post.php', [] );
	}

	public function optin() {
		$data = $this->factory->create_data_holder(
			Meta\Blog::PREFIX . 'optin_',
			Data_Holder::class,
			get_option( 'page_for_posts' )
		);

		if ( $data ) {
			$optin = new Component\Optin();

			Main::get_template_part( 'Partials/Global/Optin.php', [
				'data' => $optin->get_optin( $data['form_id'] ),
			] );
		}
	}

	public function recipes() {
		$latest_posts = wp_get_recent_posts( [
			'lang'        => pll_current_language(),
			'numberposts' => 8,
			'post_status' => 'publish',
			'tax_query'   => [
				[
					'taxonomy' => 'category',
					'field'    => 'slug',
					'terms'    => 'recipes',
				],
			],
		] );

		if ( ! empty( $latest_posts ) ) {
			$data = $this->factory->create_data_holder('');
			$data['title'] = __( 'Our Moringa recipes', Main::TEXT_DOMAIN );
			$posts = new Component\Posts( $latest_posts );

			Main::get_template_part( 'Partials/Global/Items.php', [
				'data'    => $data,
				'items'   => $posts->get_posts_data(),
				'classes' => 'recipes background',
			] );
		}
	}
}
