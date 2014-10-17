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
		$entries_count = apply_filters( "fe_ajx_{$this->instance_slug}_entries_count", 100 );
		$batch_size    = apply_filters( "fe_ajx_{$this->instance_slug}_batch_size",    20  );
		$index_start   = apply_filters( "fe_ajx_{$this->instance_slug}_index_start",   0   );

		return apply_filters( "fe_ajx_{$this->instance_slug}_init",
			array(
				'entries_count'    => $entries_count,
				'batch_size'       => $batch_size,
				'index_start' => $index_start,
			)
		);
	}

	public function process( $index ) {
		// process code
		return apply_filters( "fe_ajx_{$this->instance_slug}_process",
			array(
				'success' => true,
				'index'   => $index,
				'persist' => array(),
			),
			$index
		);
	}

	public function end() {
		return apply_filters( "fe_ajx_{$this->instance_slug}_end",
			array(
				'persist' => array(),
			)
		);
	}
}
