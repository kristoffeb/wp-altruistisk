<?php

namespace Kristoffe\Content\Admin\Type\Meta;

use Kristoffe\Content\Admin\Helpers\Utility;
use Kristoffe\Content\Admin\Type\Meta\Helpers;
use Kristoffe\Content\Main;

class Shop extends Meta_Page {

	const PREFIX = 'shop_';

	public function __construct() {
		add_action( 'cmb2_init', [ $this, 'create_fields' ] );
	}

	public function create_fields() {
		$this->create_stores_box();
	}

	public function display_box_on_condition() {
		$shop_id = (int) pll_get_post( get_option( 'woocommerce_shop_page_id' ) );

		return $shop_id == get_the_ID();
	}

	private function create_stores_box() {
		$box = $this->create_box( self::PREFIX . 'stores_', __( 'Stores', Main::TEXT_DOMAIN ) );

		$box->add_field( [
			'name' => __( 'Headline', Main::TEXT_DOMAIN ),
			'id'   => 'title',
			'type' => 'text_medium',
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
