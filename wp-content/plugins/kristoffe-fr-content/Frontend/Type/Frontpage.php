<?php

namespace Kristoffe\Content\Frontend\Type;

use Kristoffe\Content\Admin\Type\Meta;
use Kristoffe\Content\Frontend\Component;
use Kristoffe\Content\Frontend\Data\Data_Holder_Factory;
use Kristoffe\Content\Main;

class Frontpage implements Page {

	/** @var Data_Holder_Factory */
	private $factory;

	public function matches_current_page() {
		return is_front_page();
	}

	public function init() {
		$this->factory = new Data_Holder_Factory( get_the_ID() );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'hero' ] );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'product' ] );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'stories' ] );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'blog' ] );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'recipes' ] );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'optin' ] );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'moringa' ] );
	}

	public function hero() {
		$data = $this->factory->create_data_holder( Meta\Frontpage::PREFIX . 'hero_' );

		if ( $data ) {
			$post = new Component\Featured_Post( $data['featured_post'] );

			Main::get_template_part( 'Partials/Global/Hero.php', [
				'hero'    => $post->get_post_data( TRUE, TRUE, 'kristoffe-hero' ),
				'is_hero' => TRUE,
				'classes' => '',
			] );
		}
	}

	public function product() {
		$data = $this->factory->create_data_holder( Meta\Frontpage::PREFIX . 'product_' );

		if ( $data['image'] ) {
			$data['image'] = wp_get_attachment_image_src( $data['image_id'], 'kristoffe-section' )[0];
		}

		if ( $data ) {
			Main::get_template_part( 'Partials/Global/Section.php', [
				'data'    => $data,
				'classes' => 'product',
			] );
		}
	}

	public function stories() {
		$data = $this->factory->create_data_holder( Meta\Frontpage::PREFIX . 'stories_' );

		if ( $data ) {
			$ids = [];
			foreach ( $data['stories'] as $story ) {
				$ids[] = (int) $story['button_cta'];
			}

			$stories = new \WP_Query( [ 'post__in' => $ids, 'post_type' => 'page' ] );
			$posts = new Component\Posts( $stories->posts );

			Main::get_template_part( 'Partials/Global/Items.php', [
				'data'    => $data,
				'items'   => $posts->get_posts_data(),
				'classes' => 'stories background',
			] );
		}
	}

	public function blog() {
		$latest_post = wp_get_recent_posts( [ 'lang' => pll_current_language(), 'numberposts' => 1, 'post_status' => 'publish' ] );
		$post = new Component\Featured_Post( reset( $latest_post )['ID'] );

		$post_data = $post->get_post_data( TRUE, TRUE, 'kristoffe-section' );
		$post_data['subheadline'] = __( 'Eat Happy Blog', Main::TEXT_DOMAIN );

		if ( ! empty( $latest_post ) ) {
			Main::get_template_part( 'Partials/Global/Section.php', [
				'data'    => $post_data,
				'classes' => 'blog',
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
					'terms'    => [ 'recipes', 'opskrifte' ],
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

	public function optin() {
		$data = $this->factory->create_data_holder( Meta\Frontpage::PREFIX . 'optin_' );

		if ( $data ) {
			$optin = new Component\Optin();

			Main::get_template_part( 'Partials/Global/Optin.php', [
				'data' => $optin->get_optin( $data['form_id'] ),
			] );
		}
	}

	public function moringa() {
		$data = $this->factory->create_data_holder( Meta\Frontpage::PREFIX . 'moringa_' );

		if ( $data['background_image'] ) {
			$data['background_image'] = wp_get_attachment_image_src( $data['background_image_id'], 'kristoffe-hero' )[0];
		}

		if ( $data ) {
			Main::get_template_part( 'Partials/Global/Section.php', [
				'data'    => $data,
				'classes' => 'moringa',
			] );
		}
	}
}
