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

After activating the plugin, view __Tools__ > __Iron Ajax__ to see an
example instance of the plugin with the hooks displayed.

Change Log
----------
2015-01-16 Replace param $persist with $batch_args on filter process
This is a breaking change if you are using the __process__ filter with a third parameter
e.g.
`add_filter( 'fe_ajx_iron_ajax_process', 'examp_iajx_process', 10, 3);`
