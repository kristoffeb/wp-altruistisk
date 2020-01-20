<?php

namespace Heartland\Content\Admin\Type;

class Bootstrap {

	/**
	 * Run bootstrap hooks for meta fields
	 */
	public function init() {
		// Meta
		new Meta\Project();
	}
}
