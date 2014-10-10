<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

class Fe_Ajx_Admin {
	public $args;

	public function __construct( $instance_id ) {
		$this->args = apply_filters( 'fe_ajx_admin', self::args( $instance_id ), $instance_id );

		add_action( 'admin_menu', array( $this, 'add_menu' ) );
	}

	public function add_menu() {
		if ( $this->args['parent_slug'] ) {
			add_submenu_page(
				$this->args['parent_slug'],
				$this->args['page_title'],
				$this->args['menu_title'],
				$this->args['capability'],
				$this->args['menu_slug'],
				$this->args['function']
			);
		} else {
			add_menu_page(
				$this->args['page_title'],
				$this->args['menu_title'],
				$this->args['capability'],
				$this->args['menu_slug'],
				$this->args['function'],
				$this->args['icon_url'],
				$this->args['position']
			);
		}
	}

	public static function load_view() {
		echo 'hi';
	}

	public static function args( $instance_id ) {
		return array(
			//'parent_slug' => 'tools.php',
			'parent_slug' => false,
			'page_title'  => $instance_id,
			'menu_title' => $instance_id,
			'capability' => 'manage_options',
			'menu_slug' => 'fe-ajx-' . sanitize_title( $instance_id ),
			'function' => array( __CLASS__, 'load_view' ),
			'icon_url' => '',
			'position' => null,
		);
	}
}
