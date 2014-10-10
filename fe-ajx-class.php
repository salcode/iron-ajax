<?php
if ( !class_exists( 'Fe_Ajx' ) ) { class Fe_Ajx {
	public $instance_id;

	public function __construct( $args=array() ) {
		$args = array_merge( self::default_args(), $args );


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
