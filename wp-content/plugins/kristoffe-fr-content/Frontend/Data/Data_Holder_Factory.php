<?php

namespace Mitfoerstejob\Content\Frontend\Data;

use Mitfoerstejob\Content\Admin\Helpers\Constants;
use Mitfoerstejob\Content\Frontend\Data\Holders\Data_Holder;

class Data_Holder_Factory {
	private $post_id;

	public function __construct( $post_id = NULL ) {
		$this->post_id = $post_id;
	}

	public function create_data_holder( $prefix, $holder_type = Data_Holder::class, $post_id = NULL ) {
		$prefix = Constants::FORM_PREFIX . $prefix;

		return $this->create_instance( NULL, $holder_type, $prefix, $post_id );
	}

	public function create_instance( $data, $holder_type, $prefix = '', $post_id = NULL ) {
		$post_id = $post_id ?: $this->post_id;
		if ( class_exists( $holder_type ) ) {
			return new $holder_type( $prefix, $post_id, $data );
		}

		return FALSE;
	}
}
