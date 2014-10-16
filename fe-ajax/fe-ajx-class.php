<?php
if ( !class_exists( 'Fe_Ajx' ) ) { class Fe_Ajx {
	public $instance_id;

	public function __construct( $args=array() ) {
		$args = array_merge( self::default_args(), $args );

		$this->instance_id = $args['instance_id'];

		if ( is_admin() ) {
			//error_log( 'is_admin' );
			if ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) {
				$this->construct_admin_not_ajax( $this->instance_id );
			} elseif ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
				$this->construct_ajax();
			}
		}
	}

	private function construct_admin_not_ajax() {
		//error_log( 'construct for admin NOT ajax' );
		require_once( 'admin/fe-ajx-admin-class.php' );
		new Fe_Ajx_Admin( $this->instance_id );

	}

	private function construct_ajax() {
		//error_log( 'construct for ajax' );
		require_once( 'ajax/fe-ajx-ajax-class.php' );
		new Fe_Ajx_Ajax( $this->instance_id );
	}


	public static function default_args() {
		return array(
			'$instance_id' => false,
		);
	}

	public static function validate_args( $args ) {
		if ( !isset( $args['instance_id']) || !$args['instance_id'] ) {
			$error = isset( $error ) ? $error : new WP_Error;

			$error->add( 'instance_id', 'instance_id is a required attribute for Fe_Ajx' );

			return $error;
		}
	}


} }
