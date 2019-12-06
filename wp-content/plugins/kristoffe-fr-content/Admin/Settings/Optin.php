<?php

namespace Kristoffe\Content\Admin\Settings;

use Kristoffe\Content\Admin\Type\Meta\Helpers\Sanitization_Filters;
use Kristoffe\Content\Main;

class Optin extends Settings_Page {

	const PREFIX = 'optin_';

	public function __construct() {
		parent::__construct( self::PREFIX, 'Optin' );
	}

	function add_meta_box() {
		$meta_box = $this->enqueue_and_create_meta_box();

		$meta_box->add_field( [
			'name' => __( 'Title', Main::TEXT_DOMAIN ),
			'id'   => 'title',
			'type' => 'text_medium',
		] );

		$meta_box->add_field( [
			'name' => __( 'Input Placeholder', Main::TEXT_DOMAIN ),
			'id'   => 'placeholder',
			'type' => 'text_medium',
		] );

		$meta_box->add_field( [
			'name' => __( 'Button Label', Main::TEXT_DOMAIN ),
			'id'   => 'button_label',
			'type' => 'text_medium',
		] );
	}
}
