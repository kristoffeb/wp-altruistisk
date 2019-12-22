<?php

namespace Mitfoerstejob\Content\Frontend;

use Mitfoerstejob\Content\Frontend\Component;
use Mitfoerstejob\Content\Frontend\Type;

class Bootstrap {

	public function __construct() {
		$this->init();
	}

	/**
	 * Run core bootstrap hooks.
	 */
	public function init() {
		// Global
		new Component\Header();
		// new Component\Footer();

		add_action( 'wp', [ $this, 'load_pages' ], 10 );
	}

	public function load_pages() {
		$page_rendering_classes = [
			// Type\About::class,
			// Type\Blog::class,
			Type\Frontpage::class,
			// Type\Post::class,
			// Type\Single::class,
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
