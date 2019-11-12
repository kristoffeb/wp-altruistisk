<?php

namespace Kristoffe\Content\Admin\Type\Meta;

use Kristoffe\Content\Admin\Helpers\Utility;
use Kristoffe\Content\Admin\Type\Meta\Helpers;
use Kristoffe\Content\Main;

class Frontpage extends Meta_Page {

	const PREFIX = 'frontpage_';

	public function __construct() {
		add_action( 'cmb2_init', [ $this, 'create_fields' ] );
	}

	public function create_fields() {
		$this->create_hero_box();
		$this->create_product_box();
		$this->create_stories_box();
		$this->create_optin_box();
		$this->create_moringa_box();
	}

	public function display_box_on_condition() {
		$frontpage_id = (int) pll_get_post( get_option( 'page_on_front' ) );

		return $frontpage_id == get_the_ID();
	}

	private function create_hero_box() {
		$box = $this->create_box( self::PREFIX . 'hero_', __( 'Hero', Main::TEXT_DOMAIN ) );

		$box->add_field( [
			'name'            => __( 'Button Target', Main::TEXT_DOMAIN ),
			'id'              => 'featured_post',
			'type'            => 'post_search_text',
			'post_type'       => [ 'post', 'page' ],
			'select_type'     => 'radio',
			'select_behavior' => 'replace',
		] );
	}

	private function create_product_box() {
		$box = $this->create_box( self::PREFIX . 'product_', __( 'Product', Main::TEXT_DOMAIN ) );

		$box->add_field( [
			'name' => __( 'Headline', Main::TEXT_DOMAIN ),
			'id'   => 'title',
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

	private function create_stories_box() {
		$box = $this->create_box( self::PREFIX . 'stories_', __( 'Stories', Main::TEXT_DOMAIN ) );

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

		$group = $box->create_group( 'stories', '', 'story' );

		$group->add_field( [
			'name'            => __( 'Button Target', Main::TEXT_DOMAIN ),
			'id'              => 'button_cta',
			'type'            => 'post_search_text',
			'post_type'       => [ 'post', 'page' ],
			'select_type'     => 'radio',
			'select_behavior' => 'replace',
		] );
	}

	private function create_optin_box() {
		$box = $this->create_box( self::PREFIX . 'optin_', __( 'Newsletter Optin', Main::TEXT_DOMAIN ) );

		$box->add_field( [
			'name' => __( 'Active Campaign Form ID', Main::TEXT_DOMAIN ),
			'id'   => 'form_id',
			'type' => 'text_small',
		] );
	}

	private function create_moringa_box() {
		$box = $this->create_box( self::PREFIX . 'moringa_', __( 'Moringa', Main::TEXT_DOMAIN ) );

		$box->add_field( [
			'name' => __( 'Headline', Main::TEXT_DOMAIN ),
			'id'   => 'title',
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
			'name' => __( 'Background Image', Main::TEXT_DOMAIN ),
			'id'   => 'background_image',
			'type' => 'file',
		] );
	}
}
