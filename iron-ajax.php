<?php
/*
 * Plugin Name: Iron Ajax
 * Plugin URI: http://salferrarello.com/
 * Description: Sets up an instance of class Fe_Ajx, which creates a WordPress admin page for processing lots of items through ajax calls.
 * Version: 0.1.0
 * Author: Sal Ferrarello
 * Author URI: http://salferrarello.com/
 * Text Domain: iron-ajax
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

include( 'fe-ajax/fe-ajx-class.php' );

/* instantiate default instance of Fe_Ajx
 * additional instances can be declared elsewhere
 * e.g. mu-plugins, a plugin, functions.php
 */
new Fe_Ajx( array(
	'instance_id' => 'Iron Ajax',
) );
