<?php

namespace Heartland\Content\Frontend\Type;

use Heartland\Content\Admin\Type\Meta;
use Heartland\Content\Frontend\Component;
use Heartland\Content\Frontend\Data\Data_Holder_Factory;
use Heartland\Content\Main;

class Single implements Page {

	/** @var Data_Holder_Factory */
	private $factory;

	public function matches_current_page() {
		return is_page() && ! is_cart() && ! is_checkout() && ! is_account_page();
	}

	public function init() {
		$this->factory = new Data_Holder_Factory( get_the_ID() );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'content' ] );
	}

	public function content() {
		$post = new Component\Featured_Post( get_the_ID() );

		$post_data = $post->get_post_data( FALSE, FALSE );

		if ( ! empty( $post ) ) {
			Main::get_template_part( 'Partials/Global/Section.php', [
				'data'    => $post_data,
				'classes' => 'content',
			] );
		}
	}
}
