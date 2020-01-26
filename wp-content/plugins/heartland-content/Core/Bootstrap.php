<?php

namespace Heartland\Content\Core;

/**
 * Bootstraps custom post types that needs to be accessible on the frontend
 */
class Bootstrap {
	public function __construct() {
		$this->init();
	}

	public function init() {
		new Type\Artist();

		new Shortcode\Artists();
		new Shortcode\Latest_Posts();
	}
}
