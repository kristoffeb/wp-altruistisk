<?php
/**
 * Everything that modifies the administration screens
 *
 * @package WordPress
 *
 */

namespace Altruistisk\Admin;

/**
 * Adds custom js and css for admin panel
 */
function enqueue() {
	wp_enqueue_script( 'admin-js', get_template_directory_uri() . '/assets/dist/admin.min.js' );
	wp_enqueue_style( 'admin-css', get_template_directory_uri() . '/assets/dist/admin.min.css' );
}

add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\enqueue', 1 );

/**
 * Gutenberg editor styling
 */
function enqueue_editor_scripts() {
	wp_enqueue_style( 'editor-style', THEME_URI . '/assets/dist/editor-style.css', [], filemtime( get_stylesheet_directory() . '/assets/dist/editor-style.css' ), FALSE );
}

add_action( 'enqueue_block_editor_assets', __NAMESPACE__ . '\enqueue_editor_scripts' );
