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
			return;
		}
		$step_slug = self::get_post_value( 'step' );

		require_once( 'fe-ajx-ajax-steps-class.php' );

		$steps = new Fe_Ajx_Ajax_Steps( $instance_id );

		if ( method_exists( $steps, $step_slug ) ) {
			echo json_encode( $steps->$step_slug() );
		}
		die();
	}

	public static function get_post_value( $key ) {
		if ( !isset( $_POST[ $key ] ) ) {
			return false;
		}
		return $_POST[ $key ];
	}
}
