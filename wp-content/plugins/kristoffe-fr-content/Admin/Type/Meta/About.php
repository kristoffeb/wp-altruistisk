<?php

namespace Kristoffe\Content\Admin\Type\Meta;

use Kristoffe\Content\Admin\Helpers\Utility;
use Kristoffe\Content\Admin\Type\Meta\Helpers;
use Kristoffe\Content\Main;

class About extends Meta_Page {

	const PREFIX = 'about_';

	public function __construct() {
		add_action( 'cmb2_init', [ $this, 'create_fields' ] );
	}

	public function create_fields() {
		$this->create_mission_box();
		$this->create_founder_box();
		$this->create_team_box();
		$this->create_testimonial_box();
		$this->create_stores_box();
	}

	public function display_box_on_condition() {
		$post = get_post( get_the_ID() );

		return $post->post_name === 'about';
	}

	private function create_mission_box() {
		$box = $this->create_box( self::PREFIX . 'mission_', __( 'Mission', Main::TEXT_DOMAIN ) );

		$box->add_field( [
			'name' => __( 'Headline', Main::TEXT_DOMAIN ),
			'id'   => 'title',
			'type' => 'text_medium',
		] );

		$box->add_field( [
			'name' => __( 'Subheadline', Main::TEXT_DOMAIN ),
			'id'   => 'subheadline',
			'type' => 'text_medium',
		] );

		$box->add_field( [
			'name' => __( 'Text', Main::TEXT_DOMAIN ),
			'id'   => 'text',
			'type' => 'textarea_small',
		] );

		$box->add_field( [
			'name' => __( 'Button label', Main::TEXT_DOMAIN ),
			'id'   => 'button_label',
			'type' => 'text_medium',
		] );

		$box->add_field( [
			'name'            => __( 'Button Target', Main::TEXT_DOMAIN ),
			'id'              => 'button_cta',
			'type'            => 'post_search_text',
			'post_type'       => [ 'post', 'page' ],
			'select_type'     => 'radio',
			'select_behavior' => 'replace',
		] );

		$box->add_field( [
			'name' => __( 'Image', Main::TEXT_DOMAIN ),
			'id'   => 'image',
			'type' => 'file',
		] );
	}

	private function create_founder_box() {
		$box = $this->create_box( self::PREFIX . 'founder_', __( 'Founder', Main::TEXT_DOMAIN ) );

		$box->add_field( [
			'name' => __( 'Headline', Main::TEXT_DOMAIN ),
			'id'   => 'title',
			'type' => 'text_medium',
		] );

		$box->add_field( [
			'name' => __( 'Subheadline', Main::TEXT_DOMAIN ),
			'id'   => 'subheadline',
			'type' => 'text_medium',
		] );

		$box->add_field( [
			'name' => __( 'Text', Main::TEXT_DOMAIN ),
			'id'   => 'text',
			'type' => 'textarea_small',
		] );

		$box->add_field( [
			'name' => __( 'Button label', Main::TEXT_DOMAIN ),
			'id'   => 'button_label',
			'type' => 'text_medium',
		] );

		$box->add_field( [
			'name'            => __( 'Button Target', Main::TEXT_DOMAIN ),
			'id'              => 'button_cta',
			'type'            => 'post_search_text',
			'post_type'       => [ 'post', 'page' ],
			'select_type'     => 'radio',
			'select_behavior' => 'replace',
		] );

		$box->add_field( [
			'name' => __( 'Image', Main::TEXT_DOMAIN ),
			'id'   => 'image',
			'type' => 'file',
		] );
	}

	private function create_team_box() {
		$box = $this->create_box( self::PREFIX . 'team_', __( 'Team', Main::TEXT_DOMAIN ) );

		$box->add_field( [
			'name' => __( 'Title', Main::TEXT_DOMAIN ),
			'id'   => 'title',
			'type' => 'text_medium',
		] );

		$box->add_field( [
			'name' => __( 'Subheadline', Main::TEXT_DOMAIN ),
			'id'   => 'subheadline',
			'type' => 'textarea_small',
		] );

		$group = $box->create_group( 'team', '', 'item' );

		$group->add_field( [
			'name' => __( 'Title', Main::TEXT_DOMAIN ),
			'id'   => 'title',
			'type' => 'text_medium',
		] );

		$group->add_field( [
			'name' => __( 'Text', Main::TEXT_DOMAIN ),
			'id'   => 'text',
			'type' => 'textarea_small',
		] );

		$group->add_field( [
			'name' => __( 'Image', Main::TEXT_DOMAIN ),
			'id'   => 'image',
			'type' => 'file',
		] );

		$box->add_field( [
			'name' => __( 'Button label', Main::TEXT_DOMAIN ),
			'id'   => 'button_label',
			'type' => 'text_medium',
		] );

		$box->add_field( [
			'name'            => __( 'Button Target', Main::TEXT_DOMAIN ),
			'id'              => 'button_cta',
			'type'            => 'post_search_text',
			'post_type'       => [ 'post', 'page' ],
			'select_type'     => 'radio',
			'select_behavior' => 'replace',
		] );
	}

	private function create_testimonial_box() {
		$box = $this->create_box( self::PREFIX . 'testimonial_', __( 'Testimonial', Main::TEXT_DOMAIN ) );

		$box->add_field( [
			'name' => __( 'Image', Main::TEXT_DOMAIN ),
			'id'   => 'image',
			'type' => 'file',
		] );

		$box->add_field( [
			'name' => __( 'Quote', Main::TEXT_DOMAIN ),
			'id'   => 'quote',
			'type' => 'textarea_small',
		] );

		$box->add_field( [
			'name' => __( 'Author', Main::TEXT_DOMAIN ),
			'id'   => 'quote_author',
			'type' => 'textarea_small',
		] );

		$box->add_field( [
			'name' => __( 'Button label', Main::TEXT_DOMAIN ),
			'id'   => 'button_label',
			'type' => 'text_medium',
		] );

		$box->add_field( [
			'name'            => __( 'Button Target', Main::TEXT_DOMAIN ),
			'id'              => 'button_cta',
			'type'            => 'post_search_text',
			'post_type'       => [ 'post', 'page' ],
			'select_type'     => 'radio',
			'select_behavior' => 'replace',
		] );
	}

	private function create_stores_box() {
		$box = $this->create_box( self::PREFIX . 'stores_', __( 'Stores', Main::TEXT_DOMAIN ) );

		$box->add_field( [
			'name' => __( 'Title', Main::TEXT_DOMAIN ),
			'id'   => 'title',
			'type' => 'text_medium',
		] );

		$box->add_field( [
			'name' => __( 'Subheadline', Main::TEXT_DOMAIN ),
			'id'   => 'subheadline',
			'type' => 'textarea_small',
		] );

		$group = $box->create_group( 'team', '', 'item' );

		$group->add_field( [
			'name' => __( 'Title', Main::TEXT_DOMAIN ),
			'id'   => 'title',
			'type' => 'text_medium',
		] );

		$group->add_field( [
			'name' => __( 'Text', Main::TEXT_DOMAIN ),
			'id'   => 'text',
			'type' => 'textarea_small',
		] );

		$group->add_field( [
			'name' => __( 'Image', Main::TEXT_DOMAIN ),
			'id'   => 'image',
			'type' => 'file',
		] );

		$box->add_field( [
			'name' => __( 'Button label', Main::TEXT_DOMAIN ),
			'id'   => 'button_label',
			'type' => 'text_medium',
		] );

		$box->add_field( [
			'name'            => __( 'Button Target', Main::TEXT_DOMAIN ),
			'id'              => 'button_cta',
			'type'            => 'post_search_text',
			'post_type'       => [ 'post', 'page' ],
			'select_type'     => 'radio',
			'select_behavior' => 'replace',
		] );
	}
}
