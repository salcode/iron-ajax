<?php
/* Steps for AJAX calls
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) { die; }

class Fe_Ajx_Ajax_Steps {
	public $instance_id, $instance_slug;
	public function __construct( $instance_id ) {
		$this->instance_id = $instance_id;
		$this->instance_slug = Fe_Ajx::slugify( $instance_id );
	}

	public function init() {
		// init code
		error_log( 'method init ' . $this->instance_id );
		$entries_count = apply_filters( 'fe_ajx_' . $this->instance_slug . '_entries_count', 100 );
		$batch_size    = apply_filters( 'fe_ajx_' . $this->instance_slug . '_batch_size',    20  );
		$index_start   = apply_filters( 'fe_ajx_' . $this->instance_slug . '_index_start',   0   );

		return apply_filters( 'fe_ajx_' . $this->instance_slug . '_init_data',
			array(
				'entries_count'    => $entries_count,
				'batch_size'       => $batch_size,
				'item_index_start' => $index_start,
			)
		);
	}

	public function process( $index ) {
		error_log( 'method process' );
		// process code
		return apply_filters( 'fe_ajx_' . $this->instance_slug . '_process_result',
			array(
				'success' => true,
				'index'   => 0,
				'persist' => array(),
			)
		);
	}

	public function end() {
		error_log( 'method end' );
		return apply_filters( 'fe_ajx_' . $this->instance_slug . '_end',
			array(
				'persist' => array(),
			)
		);
	}
}
