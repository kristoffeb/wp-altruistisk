<?php

namespace Altruistisk\Content\Frontend;

use Altruistisk\Content\Frontend\Component;
use Altruistisk\Content\Frontend\Type;

class Bootstrap {

	public function __construct() {
		$this->init();
	}

	/**
	 * Run core bootstrap hooks.
	 */
	public function init() {
		add_action( 'wp', [ $this, 'load_pages' ], 10 );
	}

	public function load_pages() {
		$page_rendering_classes = [
			Type\Blog::class,
			Type\Post::class,
		];
		$this->load_matching_page_class( $page_rendering_classes );
	}

	public function load_matching_page_class( array $class_names ) {
		foreach ( $class_names as $class_name ) {
			/** @var Type\Page $class */
			$class = new $class_name;

			if ( $class->matches_current_page() ) {
				$class->init();

				return;
			}
		}
	}
}
