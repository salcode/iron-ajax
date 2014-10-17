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
		$entries_count = apply_filters( 'fe_ajx_entries_count_' . $this->instance_slug, 100 );
		$batch_size    = apply_filters( 'fe_ajx_batch_size_' . $this->instance_slug,    20  );
		$index_start   = apply_filters( 'fe_ajx_index_start_' . $this->instance_slug,   0   );

		return apply_filters( 'fe_ajx_init_data_' . $this->instance_slug,
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
		return apply_filters( 'fe_ajx_process_result_' . $this->instance_slug,
			array(
				'success' => true,
				'index'   => 0,
				'persist' => array(),
			)
		);
	}

	public function end() {
		error_log( 'method end' );
		return apply_filters( 'fe_ajx_end_' . $this->instance_slug,
			array(
				'persist' => array(),
			)
		);
	}
}
