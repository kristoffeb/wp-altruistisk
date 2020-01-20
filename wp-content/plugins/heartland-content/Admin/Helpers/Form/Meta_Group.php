<?php

namespace Heartland\Content\Admin\Helpers\Form;

use CMB2;

class Meta_Group {
	private $group_id;

	/** @var CMB2 */
	private $cmb;

	public function __construct( $cmb, $group_id ) {
		$this->cmb      = $cmb;
		$this->group_id = $group_id;
	}

	public function add_field( $data, $position = 0 ) {
		return $this->cmb->add_group_field( $this->group_id, $data, $position );
	}

	public function get_group_id() {
		return $this->group_id;
	}
}
