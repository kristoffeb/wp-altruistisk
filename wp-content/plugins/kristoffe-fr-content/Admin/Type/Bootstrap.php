<?php

namespace Mitfoerstejob\Content\Admin\Type;

class Bootstrap {

	/**
	 * Run bootstrap hooks for meta fields
	 */
	public function init() {
		// Meta
		new Meta\Project();
	}
}
