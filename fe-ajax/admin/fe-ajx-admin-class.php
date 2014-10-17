<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

class Fe_Ajx_Admin {
	public $args, $instance_id, $instance_slug;

	public function __construct( $instance_id ) {
		$this->instance_id = $instance_id;
		$this->instance_slug = Fe_Ajx::slugify( $this->instance_id );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'register_assets' ) );
		$this->args = apply_filters( "fe_ajx_{$this->instance_slug}_admin_args", $this->args( $instance_id ) );

		// in method add_menu, we also hook into the generated
		// menu_hookname to only enqueue assets on this page
		add_action( 'admin_menu', array( $this, 'add_menu' ) );

		// add developer information on the template page
		// this can be removed
		// remove_action( "fe_ajx_{$this->instance_slug}_template_after", array( 'Fe_Ajx_Admin', 'display_developer_hooks' ) );
		add_action( "fe_ajx_{$this->instance_slug}_template_after",
			array( __CLASS__, 'display_developer_hooks' ),
			10, 2
		);
	}

	public function add_menu() {
		if ( $this->args['parent_slug'] ) {
			$menu_hookname = add_submenu_page(
				$this->args['parent_slug'],
				$this->args['page_title'],
				$this->args['menu_title'],
				$this->args['capability'],
				$this->args['menu_slug'],
				$this->args['function']
			);
		} else {
			$menu_hookname = add_menu_page(
				$this->args['page_title'],
				$this->args['menu_title'],
				$this->args['capability'],
				$this->args['menu_slug'],
				$this->args['function'],
				$this->args['icon_url'],
				$this->args['position']
			);
		}
		// use the $menu_hookname to only enqueue assets on this page
		add_action( 'load-' . $menu_hookname, array( $this, 'hook_enqueue_assets' ) );
	}

	public function args( $instance_id ) {
		return array(
			'parent_slug' => 'tools.php', // false, for a top level menu item
			'page_title'  => $instance_id,
			'menu_title' => $instance_id,
			'capability' => 'manage_options',
			'menu_slug' => 'fe-ajx-' . $this->instance_slug,
			'function' => array( $this, 'load_view' ),
			'icon_url' => '',
			'position' => null,
		);
	}

	public function load_view() {
		$instance_id = $this->instance_id;
		$instance_slug = $this->instance_slug;
		include( 'views/admin.php' );
	}

	public static function display_developer_hooks( $instance_id, $instance_slug ) {
		include( 'views/developer-information.php' );
	}


	public static function register_assets() {
		wp_register_style(
			'fe-ajx-jquery-ui-progressbar',
			plugins_url( 'assets/css/jquery-ui/jquery-ui-1.7.2.custom.css', __FILE__ ),
			array(),
			'1.7.2'
		);
		wp_register_script(
			'fe-ajx-scripts',
			plugins_url( 'assets/js/scripts.js', __FILE__ ),
			array( 'jquery-ui-progressbar' ),
			'1.0.0'
		);
	}

	public function hook_enqueue_assets( $hook_suffix ) {
		// Unfortunately we can't just enqueue our scripts here - it's too early. So register against the proper action hook to do it
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
	}

	public function enqueue_assets( $hook_suffix ) {
		wp_enqueue_style( 'fe-ajx-jquery-ui-progressbar' );
		wp_enqueue_script( 'fe-ajx-scripts' );
		$data = array(
			'instance_id' => $this->instance_id,
		);
		wp_localize_script( 'fe-ajx-scripts', 'feAjx', $data );

	}
}
