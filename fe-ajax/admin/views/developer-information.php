	<?php $alt = 1; ?>
	<h3>Developer Information</h3>
	<p>
		The behavior of this page can be modified with the following filters.
	</p>
	<table class="widefat fixed" cellspacing="0">
		<thead>
			<tr>
				<th class="manage-column">Hook</th>
				<th class="manage-column">Description</th>
			</tr>
		</thead>

		<tr class="<?php echo ( $alt++%2 ? 'alternate' : '' ); ?>">
			<td><pre>fe_ajx_<?php echo $instance_slug ?>_process</pre></td>
			<td>
				Filter to modify the returned object when an item is processed.
				This hook is where you want to add your custom processing code.
				<h4>Example</h4>
<pre>
add_filter(
	'fe_ajx_<?php echo $instance_slug; ?>_process',
	'examp_iajx_process',
	10,
	3
);
/**
 * Process a single entry in Iron Ajax
 *
 * @param associative array $response creates JSON
 *     object to pass back to client in Ajax response
 *     default:
 *       array(
 *         'success' => true, (bool)
 *         'index'   => $index, (integer)
 *         'persist' => array(), (associative array)
 *       )
 *    $response['persist'] is an empty array that can be
 *       used to persist values across process calls
 *       (and across Ajax calls)
 * @param integer $index position is items to process,
 *     indenticial to $response['index']
 * @param associative array $args used to create a value
 *     used throughout a batch process,
 *     e.g. open a csv for reading
 *
 * @return associative array Amended $response
 */
function examp_iajx_process( $response, $index, $args ) {

	// perform processing on item in position $index
	my_function_process_one_item( $index );

	return $response;
}
</pre>
			</td>
		</tr>
		<tr class="<?php echo ( $alt++%2 ? 'alternate' : '' ); ?>">
			<td><pre>fe_ajx_<?php echo $instance_slug ?>_entries_count</pre></td>
			<td>
				Filter to modify the number of items to be processed. Default is <b>100</b>
				<h4>Example</h4>
<pre>
add_filter(
	'fe_ajx_<?php echo $instance_slug; ?>_entries_count',
	'examp_iajx_entries_count'
);
function examp_iajx_entries_count( $count ) {
	$entries_count = 1000;
	return $entries_count;
}
</pre>

			</td>
		</tr>

		<tr class="<?php echo ( $alt++%2 ? 'alternate' : '' ); ?>">
			<td><pre>fe_ajx_<?php echo $instance_slug ?>_batch_size</pre></td>
			<td>
				Filter to modify the number of items to be processed in each AJAX call. Default is <b>20</b>.
				Reduce this number if you are experiencing timeouts
				<h4>Example</h4>
<pre>
add_filter(
	'fe_ajx_<?php echo $instance_slug; ?>_batch_size',
	'examp_iajx_batch_size'
);
function examp_iajx_batch_size( $size ) {
	return 2;
}

</pre>
			</td>
		</tr>

		<tr class="<?php echo ( $alt++%2 ? 'alternate' : '' ); ?>">
			<td><pre>fe_ajx_<?php echo $instance_slug ?>_index_start</pre></td>
			<td>
				Filter to modify the index of where to start processing. Default is <b>0</b><br>
			</td>
		</tr>

		<tr class="<?php echo ( $alt++%2 ? 'alternate' : '' ); ?>">
			<td><pre>fe_ajx_<?php echo $instance_slug ?>_init</pre></td>
			<td>
				Filter to modify the returned object when initialization occurs.  Default is
<pre>
array(
	'entries_count' => $entries_count,
	'batch_size'    => $batch_size,
	'index_start'   => $index_start,
)
</pre>
				<b>Note:</b> Each of these entries can be modified with their own filter, which is generally a better choice than using this filter.
			</td>
		</tr>

		<tr class="<?php echo ( $alt++%2 ? 'alternate' : '' ); ?>">
			<td><pre>fe_ajx_<?php echo $instance_slug ?>_template_after</pre></td>
			<td>
				Action to display after the content on admin page. This action is being
				used to display this developer information and can be removed with
<pre>
add_action( 'init', 'hide_iajx_dev_notes' );
function hide_iajx_dev_notes() {
	remove_action(
		'fe_ajx_<?php echo $instance_slug; ?>_template_after',
		array(
			'Fe_Ajx_Admin',
			'display_developer_hooks'
		)
	);
}
</pre>
			</td>
		</tr>

		<tr class="<?php echo ( $alt++%2 ? 'alternate' : '' ); ?>">
			<td><pre>fe_ajx_<?php echo $instance_slug ?>_template_heading</pre></td>
			<td>
				Filter to modify the heading on the admin page
<pre>
add_filter(
	'fe_ajx_<?php echo $instance_slug; ?>_ajax_template_heading',
	'examp_iajx_templ_head'
);
function examp_iajx_templ_head( $title ) {
	return 'This is a New Heading';
}
</pre>
			</td>
		</tr>


	</table>
