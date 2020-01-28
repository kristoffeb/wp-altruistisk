<?php

namespace Heartland\Content\Frontend\Type;

use Heartland\Content\Admin\Type\Meta;
use Heartland\Content\Frontend\Data\Data_Holder_Factory;
use Heartland\Content\Main;

class Blog implements Page {

	/** @var Data_Holder_Factory */
	private $factory;

	public function matches_current_page() {
		return is_home();
	}

	public function init() {
		$this->factory = new Data_Holder_Factory( get_option( 'page_for_posts' ) );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'grid' ] );
	}

	public function grid() {
		$shortcode = do_shortcode( '[latest-posts number="-1"]' );

		$grid = sprintf( '<div class="inner-grid">%s</div>', $shortcode );

		echo $grid;
	}
}
