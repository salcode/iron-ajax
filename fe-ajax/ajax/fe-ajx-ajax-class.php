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

		require_once( 'fe-ajx-ajax-steps-class.php' );

		if ( 'process' === $step_slug ) {
			return $this->batch_process();
		}

		$steps = new Fe_Ajx_Ajax_Steps( $instance_id );

		if ( method_exists( $steps, $step_slug ) ) {
			echo json_encode( $steps->$step_slug() );
		}
		die();
	}

	public function batch_process() {
		$steps = new Fe_Ajx_Ajax_Steps( $this->instance_id );

		$results = array();
		if ( !isset( $_POST['itemsBeingProcessed'] ) ) {
			echo json_encode( array(
				'error' => 'itemsBeingProcessed is NOT an array'
			) );
			die();
		}

		foreach ( $_POST['itemsBeingProcessed'] as $index ) {
			//error_log( $item );
			$results[$index] = $steps->process( $index );
		}
		$data = array(
			'results' => $results
		);

		echo json_encode( $data );
		die();
	}

	public static function get_post_value( $key ) {
		if ( !isset( $_POST[ $key ] ) ) {
			return false;
		}
		return $_POST[ $key ];
	}
}
