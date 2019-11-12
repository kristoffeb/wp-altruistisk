<?php

namespace Kristoffe\Content\Admin\Type\Meta;

use Kristoffe\Content\Admin\Helpers\Utility;
use Kristoffe\Content\Admin\Type\Meta\Helpers;
use Kristoffe\Content\Main;

class Blog extends Meta_Page {

	const PREFIX = 'blog_';

	public function __construct() {
		add_action( 'cmb2_init', [ $this, 'create_fields' ] );
	}

	public function create_fields() {
		$this->create_description_box();
		$this->create_adspace_box();
		$this->create_optin_box();
	}

	public function display_box_on_condition() {
		$blog_id = (int) pll_get_post( get_option( 'page_for_posts' ) );

		return $blog_id == get_the_ID();
	}

	private function create_description_box() {
		$box = $this->create_box( self::PREFIX . 'description_', __( 'Description', Main::TEXT_DOMAIN ) );

		$box->add_field( [
			'name' => __( 'Subheadline', Main::TEXT_DOMAIN ),
			'id'   => 'subheadline',
			'type' => 'textarea_small',
		] );
	}

	private function create_adspace_box() {
		$box = $this->create_box( self::PREFIX . 'adspace_', __( 'Adspace', Main::TEXT_DOMAIN ) );

		$box->add_field( [
			'name' => __( 'Title', Main::TEXT_DOMAIN ),
			'id'   => 'title',
			'type' => 'text_medium',
		] );

		$box->add_field( [
			'name' => __( 'Image', Main::TEXT_DOMAIN ),
			'id'   => 'image',
			'type' => 'file',
		] );

		$box->add_field( [
			'name' => __( 'Button Text', Main::TEXT_DOMAIN ),
			'id'   => 'text',
			'type' => 'text_medium',
		] );

		$box->add_field( [
			'name'            => __( 'Target', Main::TEXT_DOMAIN ),
			'id'              => 'cta',
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
}
