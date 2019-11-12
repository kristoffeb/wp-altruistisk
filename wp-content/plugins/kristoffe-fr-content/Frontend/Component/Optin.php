<?php

namespace Kristoffe\Content\Frontend\Component;

use Kristoffe\Content\Admin\Settings;
use Kristoffe\Content\Main;

class Optin {

	public function __construct() {}

	public function get_optin( $form_id = NULL ) {
		if ( empty( $form_id ) ) {
			return;
		}

		ob_start();
			echo do_shortcode( sprintf( '[activecampaign form=%s]', $form_id ) );
		$optin = ob_get_clean();

		return $optin;
	}
}
