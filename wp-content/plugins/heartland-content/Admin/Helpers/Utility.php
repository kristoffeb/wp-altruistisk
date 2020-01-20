<?php

namespace Heartland\Content\Admin\Helpers;

use Heartland\Content\Main;

class Utility {

	public static function get_brand_colors( $selection = [] ) {
		$brand = [
			'curry' => __( 'Curry', Main::TEXT_DOMAIN ),
			'mint'  => __( 'Mint', Main::TEXT_DOMAIN ),
			'plum'  => __( 'Plum', Main::TEXT_DOMAIN ),
			'rose'  => __( 'Rose', Main::TEXT_DOMAIN ),
		];

		$selection = array_flip( $selection );

		foreach ( $selection as $key => $value ) {
			$selection[ $key ] = $brand[ $key ];
		}

		return $selection;
	}

}
