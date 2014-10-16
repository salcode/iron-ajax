<?php
/* Handle incoming AJAX calls
 *
 * action:  "fe_ajx_action" (always)
 * step:    "init", "process", or "end"
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

class Fe_Ajx_Ajax {
	public $instance_id;

	public function __construct( $instance_id ) {
		$this->instance_id = $instance_id;

		add_action( "wp_ajax_fe_ajx_action", array( $this, 'ajax_action' )  );
	}

	public function ajax_action() {
		$instance_id = self::get_post_value( 'instance_id' );
		if ( !$instance_id || $instance_id !== $this->instance_id ) {
			//error_log( '$this->instance_id=' . print_r( $this->instance_id, true ) );
			//error_log( '$instance_id=' . print_r( $instance_id, true ) );
			//error_log( 'instance_id does not match' );
			return;
		}
		$step_slug = self::get_post_value( 'step' );
		//error_log( plugin_dir_path( __FILE__ ) . 'fe-ajx-aj );
		require_once( 'fe-ajx-ajax-steps-class.php' );
		$steps = new Fe_Ajx_Ajax_Steps( $instance_id );

		if ( method_exists( $steps, $step_slug ) ) {
			$steps->$step_slug();
		}
	}

	public static function get_post_value( $key ) {
		if ( !isset( $_POST[ $key ] ) ) {
			return false;
		}
		return $_POST[ $key ];
	}
}
