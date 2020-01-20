<?php

namespace Heartland\Content\Frontend\Type;

use Heartland\Content\Frontend\Component;
use Heartland\Content\Main;

class Frontpage implements Page {

	public function matches_current_page() {
		return is_front_page();
	}

	public function init() {
		add_action( 'template_include', [ $this, 'redirect_to_index' ] );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'hero' ] );
		add_action( THEMEDOMAIN . '-main_content', [ $this, 'grid' ] );
	}

	public function redirect_to_index() {
		return locate_template( 'index.php' );
	}

	public function hero() {
		the_content();
	}

	public function grid() {
		$latest_projects = new \WP_Query( [
			'post_type'   => 'project',
			'post_status' => 'publish',
		] );

		$projects = new Component\Projects( $latest_projects );
		$items = $projects->get_projects_data();

		Main::get_template_part( 'Partials/Global/Items.php', [
			'items'   => $items,
			'classes' => 'projects',
		] );
	}
}
