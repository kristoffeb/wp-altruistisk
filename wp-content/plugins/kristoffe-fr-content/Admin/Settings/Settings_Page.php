<?php
namespace Kristoffe\Content\Admin\Settings;

use Kristoffe\Content\Main;

abstract class Settings_Page {
	private $prefix;
	private $meta_box_ids = [];
	private $page_title;
	private $menu_title;

	public function __construct( $prefix, $menu_title, $page_title = '' ) {
		$this->prefix     = $prefix;
		$this->menu_title = $menu_title;
		$this->page_title = $page_title ?: $menu_title . ' - Settings';
		add_action( 'admin_init', [ $this, 'register_setting' ] );
		add_action( 'admin_menu', [ $this, 'add_admin_page' ] );
		add_action( 'cmb2_admin_init', [ $this, 'add_meta_box' ] );
		add_action( 'cmb2_save_options-page_fields', [ $this, 'handle_submit_notices' ], 10, 2 );
	}

	public function register_setting() {
		register_setting(
			$this->prefix . 'options',
			$this->prefix . 'options'
		);
	}

	public function add_admin_page() {
		$page_suffix = add_submenu_page(
			'options-general.php',
			$this->page_title,
			$this->menu_title,
			'edit_pages',
			$this->prefix . 'options',
			[ $this, 'render_admin_page' ]
		);

		// Include CMB CSS in the head to avoid FOUC
		add_action( 'admin_print_styles-' . $page_suffix, [ 'CMB2_hookup', 'enqueue_cmb_css' ] );
	}

	public function render_admin_page() {
		// Keep cmb-options-page class in the markup or the form won't save the setting
		?>
        <div class="wrap cmb-options-page">
            <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
			<?php
			foreach ( $this->meta_box_ids as $meta_box_id ) {
				cmb2_metabox_form( $meta_box_id, $this->prefix . 'options' );
			}
			?>
        </div>
		<?php
	}

	public function handle_submit_notices( $object_id, $updated ) {
		if ( $object_id !== $this->prefix . 'options' || empty( $updated ) ) {
			return;
		}
		add_settings_error( $this->prefix . 'options-notices', '', __( 'Settings updated.', Main::TEXT_DOMAIN ),
			'updated' );
		settings_errors( $this->prefix . 'options-notices' );
	}

	public abstract function add_meta_box();

	/**
	 * @return \CMB2
	 */
	protected function enqueue_and_create_meta_box( $meta_box_id = 'settings' ) {
		$meta_box_id          = $this->prefix . $meta_box_id;
		$this->meta_box_ids[] = $meta_box_id;
		$meta_box             = new_cmb2_box( [
			'id'         => $meta_box_id,
			'hookup'     => FALSE,
			'cmb_styles' => FALSE,
			'show_on'    => [
				'key'   => 'options-page',
				'value' => [ $this->prefix . 'options' ]
			],
		] );

		return $meta_box;
	}
}
