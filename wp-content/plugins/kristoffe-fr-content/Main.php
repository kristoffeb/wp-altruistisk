<?php
/**
 *
 * @package mitfoerstejob
 * @author  Kristoffe Biglete
 * @link https://make.wordpress.org/core/handbook/best-practices/coding-standards/php/
 * @link http://www.phpdoc.org/docs/latest/guides/docblocks.html
 *
 * Plugin Name: Mitfoerstejob - Content
 * Plugin URI:
 * Description: Extended native content for Mitfoerstejob
 * Version:     1.0.0
 * Author:      Kristoffe Biglete
 * Author URI:  https://github.com/kristoffeb
 * Text Domain: mitfoerstejob
 * Domain Path: /languages
 */

namespace Mitfoerstejob\Content;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require Main::plugin_path() . '/../../../vendor/autoload.php';

// Register plugin activation and deactivation hooks
register_activation_hook( __FILE__, [ Main::class, 'activate' ] );
register_deactivation_hook( __FILE__, [ Main::class, 'deactivate' ] );

new Main();

class Main {

	/**
	 * Text domain for translators
	 * Don't use "-" (dash) in the name, as it can potentially break the site if the text domain is used in a certain context.
	 */
	const TEXT_DOMAIN = 'mitfoerstejob';

	/**
	 * Do not load this more than once.
	 */
	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'bootstrap' ], 20 );
		add_action( 'after_setup_theme', [ $this, 'load_textdomain' ], 10 );

		add_action( 'admin_init', [ $this, 'admin_enqueue' ] );
	}

	public function load_textdomain() {
		load_plugin_textdomain( self::TEXT_DOMAIN, false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	public function bootstrap() {
		if ( is_admin() ) {
			$this->init_admin();
		} else {
			$this->init_frontend();
		}
		$this->init_core_types();
	}

	public function init_admin() {
		$admin = new Admin\Bootstrap;
	}

	public function init_frontend() {
		$frontend = new Frontend\Bootstrap;
	}

	public function init_core_types() {
		$core = new Core\Bootstrap;
	}

	public function admin_enqueue() {
		wp_enqueue_style( self::TEXT_DOMAIN . '-admin-css', plugins_url( 'Assets/dist/admin.css', __FILE__ ) );
	}

	public static function activate() {
		$subscriber = get_role( 'subscriber' );
		$subscriber->add_cap( 'read_private_pages' );
		$subscriber->add_cap( 'read_private_posts' );

		flush_rewrite_rules();
	}

	public static function deactivate() {
		flush_rewrite_rules();
	}

	public static function plugin_url() {
		return untrailingslashit( plugins_url( '/', __FILE__ ) );
	}

	public static function plugin_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) );
	}

	public static function template_path( $template_name ) {
		return self::plugin_path() . '/Templates/' . $template_name;
	}

	public static function template_exist( $template_name ) {
		return file_exists( self::template_path( $template_name ) );
	}

	/**
	 * Get the template part and send along any variables.
	 */
	public static function get_template_part( $template_name, $vars = [] ) {
		extract( $vars );
		include self::template_path( $template_name );
	}

}
