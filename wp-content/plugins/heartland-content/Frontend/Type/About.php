<?php

namespace Heartland\Content\Frontend\Type;

use Heartland\Content\Admin\Type\Meta;
use Heartland\Content\Frontend\Component;
use Heartland\Content\Frontend\Data\Data_Holder_Factory;
use Heartland\Content\Main;

class About implements Page {

	/** @var Data_Holder_Factory */
	private $factory;

	public function matches_current_page() {
		global $post;

		if ( empty( $post ) ) {
			return;
		}

		return is_page( 'about' );
	}

	public function init() {
		$this->factory = new Data_Holder_Factory( get_the_ID() );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'hero' ] );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'mission' ] );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'founder' ] );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'team' ] );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'testimonial' ] );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'stores' ] );
	}

	public function hero() {
		$post = new Component\Featured_Post( get_the_ID() );

		$post_data = $post->get_post_data( $excerpt = FALSE, $show_button = FALSE, 'heartland-section' );

		if ( ! empty( $post ) ) {
			Main::get_template_part( 'Partials/Global/Section.php', [
				'data'    => $post_data,
				'classes' => 'about first',
			] );
		}
	}

	public function mission() {
		$data = $this->factory->create_data_holder( Meta\About::PREFIX . 'mission_' );

		if ( $data['image'] ) {
			$data['image'] = wp_get_attachment_image_src( $data['image_id'], 'heartland-hero' )[0];
		}

		if ( $data ) {
			Main::get_template_part( 'Partials/Global/Hero.php', [
				'hero'    => $data,
				'is_hero' => FALSE,
				'classes' => '',
			] );
		}
	}

	public function founder() {
		$data = $this->factory->create_data_holder( Meta\About::PREFIX . 'founder_' );

		if ( $data['image'] ) {
			$data['image'] = wp_get_attachment_image_src( $data['image_id'], 'heartland-section' )[0];
		}

		if ( $data ) {
			Main::get_template_part( 'Partials/Global/Section.php', [
				'data'    => $data,
				'classes' => 'founder',
			] );
		}
	}

	public function team() {
		$data = $this->factory->create_data_holder( Meta\About::PREFIX . 'team_' );

		if ( $data ) {
			Main::get_template_part( 'Partials/Global/Items.php', [
				'data'    => $data,
				'items'   => $data['team'],
				'classes' => 'mission icons',
			] );
		}
	}

	public function testimonial() {
		$data = $this->factory->create_data_holder( Meta\About::PREFIX . 'testimonial_' );

		if ( $data['image'] ) {
			$data['image'] = wp_get_attachment_image_src( $data['image_id'], 'heartland-item' )[0];
		}

		if ( $data ) {
			Main::get_template_part( 'Partials/Global/Testimonial.php', [
				'data'    => $data,
			] );
		}
	}

	public function stores() {
		$data = $this->factory->create_data_holder( Meta\About::PREFIX . 'stores_' );

		if ( $data ) {
			Main::get_template_part( 'Partials/Global/Items.php', [
				'data'    => $data,
				'items'   => $data['team'],
				'classes' => 'stores icons',
			] );
		}
	}
}
