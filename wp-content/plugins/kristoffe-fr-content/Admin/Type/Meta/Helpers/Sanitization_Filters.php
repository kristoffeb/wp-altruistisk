<?php

namespace Mitfoerstejob\Content\Admin\Type\Meta\Helpers;


class Sanitization_Filters {
	public static function strip_dangerous_tags( $value, $field_args, $field ) {
		return strip_tags( $value, '<strong><br>' );
	}
}
