<?php

namespace Heartland\Content\Frontend\Type;

use Heartland\Content\Main;
use Heartland\Content\Core\Shortcode\Latest_Posts as Posts;

class Post implements Page {

	public function matches_current_page() {
		return is_singular() || is_page();
	}

	public function init() {
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'content' ] );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'post_meta' ] );
	}

	public function content() {
		while ( have_posts() ) {
			the_post();
			the_content();
		}
	}

	public function post_meta() {
		global $post;

		if ( ! is_single() ) {
			return;
		}

		$category = Posts::get_category( $post->ID );
		$date     = Posts::get_date( $post->ID );

		echo sprintf(
			'<div class="meta">%s<div class="date">%s</div></div>',
			$category,
			$date
		);
	}
}