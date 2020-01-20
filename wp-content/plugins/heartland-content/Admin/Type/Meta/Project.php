<?php

namespace Heartland\Content\Admin\Type\Meta;

use Heartland\Content\Admin\Type\Meta\Helpers;
use Heartland\Content\Main;

class Project extends Meta_Page {

	const PREFIX = 'project_';

	public function __construct() {
		add_action( 'cmb2_init', [ $this, 'create_fields' ] );
	}

	public function create_fields() {
		$this->create_info_box();

	}

	public function display_box_on_condition() {
		$post = get_post( get_the_ID() );

		return get_post_type( $post ) === 'project';
	}

	private function create_info_box() {
		$box = $this->create_box( self::PREFIX . 'info_', __( 'Info', Main::TEXT_DOMAIN ) );

		$box->add_field( [
			'name' => __( 'Subheadline', Main::TEXT_DOMAIN ),
			'id'   => 'subheadline',
			'type' => 'text_medium',
		] );
	}
}
