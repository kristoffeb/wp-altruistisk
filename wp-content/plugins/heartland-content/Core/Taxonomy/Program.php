<?php
namespace Heartland\Content\Core\Taxonomy;

use Heartland\Content\Main;
use Heartland\Content\Core\Type;

class Program {

	const TAXONOMY = 'program';

	public function __construct() {
		$this->taxonomy();
	}

	public function taxonomy() {
		register_taxonomy(
			self::TAXONOMY,
			[ Type\Artist::POST_TYPE ],
			[
				'label'             => __( 'Program Category', Main::TEXT_DOMAIN ),
				'rewrite'           => [ 'slug' => 'program' ],
				'hierarchical'      => TRUE,
				'query_var'         => TRUE,
				'show_admin_column' => TRUE,
				'show_ui'           => TRUE,
				'show_in_rest'      => TRUE,
			]
		);
	}
}
