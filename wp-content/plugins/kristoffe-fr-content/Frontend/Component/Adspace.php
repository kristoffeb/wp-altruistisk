<?php

namespace Mitfoerstejob\Content\Frontend\Component;

use Mitfoerstejob\Content\Admin\Type\Meta;
use Mitfoerstejob\Content\Frontend\Data\Data_Holder_Factory;
use Mitfoerstejob\Content\Main;

class Adspace {

	private $factory;

	public function __construct() {
		$this->factory = new Data_Holder_Factory( get_option( 'page_for_posts' ) );
	}

	public function get_item() {
		$data = $this->factory->create_data_holder( Meta\Blog::PREFIX . 'adspace_' );

		$item = [
			'class' => 'space',
			'image' => $data['image'],
			'title' => $data['title'],
			'text'  => $data['text'],
			'cta'   => get_permalink( $data['cta'] ),
		];

		return $item;
	}
}
