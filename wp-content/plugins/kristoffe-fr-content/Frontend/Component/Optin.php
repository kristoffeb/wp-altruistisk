<?php

namespace Mitfoerstejob\Content\Frontend\Component;

use Mitfoerstejob\Content\Admin\Settings;
use Mitfoerstejob\Content\Main;

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
