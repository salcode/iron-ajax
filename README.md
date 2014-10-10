Iron Ajax Class
===============

What it does
------------
Allows you to quickly create a WordPress admin page which processes
a large amount of data via ajax calls to avoid timeouts.


How it works
------------
Once you create an instance of the class, you can use WordPress
hooks and filters to modify it for the desired behavior.

Bare Minimum Setup
------------------
```
new Fe_Ajx( array(
	'instance_id' => 'fe-ajax-example1',
) );

add_filter( 'fe_ajx_num_items', 'my_fe_ajax_num_items', 10, 2 );
add_filter( 'fe_ajx_process',   'my_fe_ajax_num_items', 10, 2 );

function my_fe_ajax_num_items( $count, $instance_id ) {
	if ( 'fe-ajax-example1' !== $instance_id ) {
		return $count;
	}
	// the number of ajax items
	return 20;
}

function my_fe_ajax_process( $result, $instance_id, $index ) {
	if ( 'fe-ajax-example1' !== $instance_id ) {
		return $result;
	}
	return true;
}
```

