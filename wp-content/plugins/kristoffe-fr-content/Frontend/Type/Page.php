<?php

namespace Kristoffe\Content\Frontend\Type;


interface Page {
	public function matches_current_page();

	public function init();
}
