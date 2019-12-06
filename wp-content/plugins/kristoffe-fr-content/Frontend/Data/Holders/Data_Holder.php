<?php

namespace Kristoffe\Content\Frontend\Data\Holders;

class Data_Holder implements \ArrayAccess {

	protected $data = [];
	protected $prefix;
	protected $post_id;

	public function __construct( $prefix, $post_id, $data = NULL ) {
		$this->post_id = $post_id;
		$this->prefix  = $prefix;
		if ( ! empty( $data ) ) {
			$this->data = $data;
		}
	}

	public function offsetGet( $offset ) {
		if ( array_key_exists( $this->prefix . $offset, $this->data ) ) {
			return $this->data[ $this->prefix . $offset ];
		} else if ( $this->post_id != NULL ) {
			return $this->data[ $this->prefix . $offset ] = get_post_meta( $this->post_id, $this->prefix . $offset,
				TRUE );
		}

		return NULL;
	}

	public function offsetExists( $offset ) {
		return array_key_exists( $this->prefix . $offset, $this->data );
	}

	public function offsetSet( $offset, $value ) {
		$this->data[ $this->prefix . $offset ] = $value;
	}

	public function offsetUnset( $offset ) {
	}
}
