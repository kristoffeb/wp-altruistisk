<?php

namespace Kristoffe\Content\Admin\Type;

use Kristoffe\Content\Admin\Helpers;
use Kristoffe\Content\Main;

class Adspace {

	const POST_TYPE = 'adspace';

	public function __construct() {
		$this->post_type();
	}

	/**
	 * Declare post type.
	 *
	 * @since 1.1.0
	 */
	public function post_type() {
		$this->post_type = new Helpers\Custom_Post_Type( [
			'post_type_name' => self::POST_TYPE,
			'singular'       => __( 'AdSpace', Main::TEXT_DOMAIN ),
			'plural'         => __( 'AdSpaces', Main::TEXT_DOMAIN ),
			'slug'           => __( 'adspace', Main::TEXT_DOMAIN ),
		],
		[
			'supports'    => [ 'title', 'thumbnail', 'editor' ],
			'menu_icon'   => 'dashicons-analytics',
			'public'      => TRUE,
			'has_archive' => TRUE,
			'rewrite'     => [
				'with_front' => FALSE,
				'slug'       => __( 'adspaces', Main::TEXT_DOMAIN ),
			],
		] );
	}
}
