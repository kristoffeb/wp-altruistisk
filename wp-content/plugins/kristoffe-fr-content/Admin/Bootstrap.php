<?php

namespace Kristoffe\Content\Admin;

class Bootstrap {

	public function __construct() {
		$this->init();
	}

	/**
	 * Run core bootstrap hooks.
	 */
	public function init() {
		// Settings
		// new Settings\Optin();

		// Taxonomy
		// new Taxonomy\Product_Cat();

		// Types
		$type = new Type\Bootstrap();
		$type->init();
	}
}
