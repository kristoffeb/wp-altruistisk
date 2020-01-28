<?php

namespace Heartland\Content\Frontend\Type;

use Heartland\Content\Main;

class Post implements Page {

	public function matches_current_page() {
		return is_singular() || is_page();
	}

	public function init() {
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'content' ] );
	}

	public function content() {
		while ( have_posts() ) {
			the_post();
			the_content();
		}
	}
}
