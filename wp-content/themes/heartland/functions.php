<?php
/**
 * The main functions file for WordPress Theme Features
 *
 * @link http://codex.wordpress.org/Theme_Features
 * @link http://codex.wordpress.org/Functions_File_Explained
 * @package WordPress
 *
 */

namespace Heartland;

/**
 * Theme setup
 */
function theme_setup() {

	// Theme domain
	if( ! defined( 'THEMEDOMAIN' ) ) {
		define( 'THEMEDOMAIN', __NAMESPACE__ );
	}

	define( 'THEME_DIR', dirname( __FILE__ ) );
	define( 'THEME_URI', str_replace( ['http:'], [''], get_template_directory_uri() ) );

	// Loads theme languages
	load_theme_textdomain( THEMEDOMAIN, get_template_directory() . '/languages' );

	// Include function files
	get_template_part( 'includes/functions-helpers' );
	get_template_part( 'includes/functions-hooks' );

	// Include on admin and login page
	if ( is_admin() ) {
		get_template_part( 'includes/functions-admin' );
	}

	// Theme support
	add_theme_support( 'custom-header' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'menus' );
	add_theme_support( 'automatic_feed_links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', [ 'search-form', 'comment-list', 'comment-form', 'gallery', 'caption' ] );

	// Image sizes
	set_post_thumbnail_size( 125, 125, true ); // default thumb size
	add_image_size( __NAMESPACE__ . '-small',            300, 169, true );   // 16/9 small
	add_image_size( __NAMESPACE__ . '-loop',             330, 230, true );   // 16/9 used in the loop
	add_image_size( __NAMESPACE__ . '-medium',           640, 369, true );   // 16/9 medium
	add_image_size( __NAMESPACE__ . '-large',            800, 450, true );   // 16/9 large
	add_image_size( __NAMESPACE__ . '-tile-large',       725, 725, true );   // Tile large
	add_image_size( __NAMESPACE__ . '-tile-medium',      320, 320, true );   // Tile large
	add_image_size( __NAMESPACE__ . '-portfolio-medium', 370, 9999 );  // Portfolio medium
	add_image_size( __NAMESPACE__ . '-portfolio-large',  1240, 9999 ); // Portfolio large

	// Navigation
	register_nav_menus(	array(
		'main-nav' => __( 'Main Navigation', THEMEDOMAIN ),
	) );

	// Footer area
	register_sidebar( [
		'name' => __( 'Footer Area', THEMEDOMAIN ),
		'id'   => 'sidebar-footer',
	] );
}

add_action( 'after_setup_theme', __NAMESPACE__ . '\theme_setup' );
