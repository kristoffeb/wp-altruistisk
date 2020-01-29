<?php

namespace Heartland\Content\Core\Type;

use Heartland\Content\Admin\Helpers;
use Heartland\Content\Main;

class Artist {

	const POST_TYPE = 'artist';

	public function __construct() {
		$this->post_type();
	}

	public function post_type() {
		$this->post_type = new Helpers\Custom_Post_Type(
			[
				'post_type_name' => self::POST_TYPE,
				'singular'       => __( 'Artist', Main::TEXT_DOMAIN ),
				'plural'         => __( 'Artists', Main::TEXT_DOMAIN ),
				'slug'           => __( 'artist', Main::TEXT_DOMAIN ),
			],
			[
				'supports'          => [ 'title', 'editor', 'thumbnail', 'page-attributes' ],
				'menu_icon'         => 'dashicons-megaphone',
				'public'            => TRUE,
				'has_archive'       => TRUE,
				'hierarchical'      => TRUE,
				'taxonomies'        => [ 'program' ],
				'show_ui'           => TRUE,
				'show_in_nav_menus' => TRUE,
				'show_in_rest'		=> TRUE,
				'capability_type'   => 'post',
				'rewrite'           => [
					'feeds'      => TRUE,
					'with_front' => FALSE,
					'slug'       => 'artist',
				],
			]
		);
	}
}
