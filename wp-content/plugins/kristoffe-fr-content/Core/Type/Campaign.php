<?php

namespace Kristoffe\Content\Core\Type;

use Kristoffe\Content\Admin\Helpers;
use Kristoffe\Content\Main;

class Campaign {

	const POST_TYPE = 'campaign';

	public function __construct() {
		$this->post_type();
	}

	/**
	 * Declare post type.
	 *
	 * @since 1.2.2
	 */
	public function post_type() {
		$this->post_type = new Helpers\Custom_Post_Type(
			[
				'post_type_name' => self::POST_TYPE,
				'singular'       => __( 'Campaign', Main::TEXT_DOMAIN ),
				'plural'         => __( 'Campaigns', Main::TEXT_DOMAIN ),
				'slug'           => __( 'campaign', Main::TEXT_DOMAIN ),
			],
			[
				'supports'          => [ 'title', 'page-attributes', 'page_template', 'thumbnail' ],
				'menu_icon'         => 'dashicons-megaphone',
				'public'            => TRUE,
				'has_archive'       => TRUE,
				'hierarchical'      => TRUE,
				'taxonomies'        => [ 'category' ],
				'show_ui'           => TRUE,
				'show_in_nav_menus' => FALSE,
				'capability_type'   => 'post',
				'rewrite'           => [
					'feeds'      => TRUE,
					'with_front' => FALSE,
					'slug'       => 'cmp',
				],
			]
		);
	}
}
