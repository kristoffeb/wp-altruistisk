<?php

namespace Heartland\Content\Admin\Helpers\Form;

use CMB2;
use Heartland\Content\Admin\Helpers\Constants;

class Meta_Box {
	/** @var CMB2 */
	private $cmb;

	private $prefix;

	public function __construct( $prefix, $data ) {
		$this->prefix  = Constants::FORM_PREFIX . $prefix;
		$data['id']    = $this->add_prefix_to_id( $data['id'] );
		$this->cmb     = new_cmb2_box( $data );
	}

	private function add_prefix_to_id( $id ) {
		return $this->prefix . $id;
	}

	public function add_field( $data, $position = 0 ) {
		$data['id'] = $this->add_prefix_to_id( $data['id'] );
		if ( isset ( $data['attributes']['data-conditional-id'] ) ) {
			$data['attributes']['data-conditional-id'] = $this->add_prefix_to_id( $data['attributes']['data-conditional-id'] );
		}

		return $this->cmb->add_field( $data, $position );
	}

	/**
	 * @param $id
	 * @param string $title Group label
	 * @param string $item_title Label on the buttons
	 *
	 * @return Meta_Group
	 */
	public function create_group( $id, $title = 'Items', $item_title = 'item' ) {
		$group_id = $this->cmb->add_field( [
			'id'          => $this->add_prefix_to_id( $id ),
			'type'        => 'group',
			'name'        => '',
			'description' => $title,
			'options'     => [
				'group_title'   => ucfirst( $item_title ) . ' {#}',
				'add_button'    => 'Add another ' . $item_title,
				'remove_button' => 'Remove ' . $item_title,
				'sortable'      => TRUE,
				'closed'        => TRUE
			],
		] );

		return new Meta_Group( $this->cmb, $group_id );
	}
}
