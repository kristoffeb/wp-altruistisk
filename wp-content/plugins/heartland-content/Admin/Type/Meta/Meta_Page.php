<?php

namespace Heartland\Content\Admin\Type\Meta;

use Heartland\Content\Admin\Helpers\Form\Meta_Box;

abstract class Meta_Page {

	public abstract function create_fields();

	/** Callback method */
	public abstract function display_box_on_condition();

	/**
	 * Overrideable method, that creates repetitive instantiating of cmb box
	 *
	 * @param $prefix string Prefix for all the fields in the box
	 * @param $title string Title of the box
	 *
	 * @return Meta_Box
	 */
	protected function create_box( $prefix, $title, $args = [] ) {
		$data = [
			'id'           => 'box', // Ids will be unique thanks to prefix setting in Meta_Box
			'title'        => $title,
			'object_types' => [ 'page', 'project' ],
			'show_on_cb'   => [ $this, 'display_box_on_condition' ],
		];

		if ( ! empty( $args ) ) {
			$data = array_merge( $data, $args );
		}

		return new Meta_Box( $prefix, $data );
	}
}
