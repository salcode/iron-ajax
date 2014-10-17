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

		<tr class="alternate">
			<td><pre>fe_ajx_<?php echo $instance_slug ?>_entries_count</pre></td>
			<td>
				Filter to modify the number of items to be processed. Default is <b>100</b>
			</td>
		</tr>

		<tr class="alternate">
			<td><pre>fe_ajx_<?php echo $instance_slug ?>_batch_size</pre></td>
			<td>
				Filter to modify the number of items to be processed. Default is <b>20</b>
			</td>
		</tr>

		<tr class="alternate">
			<td><pre>fe_ajx_<?php echo $instance_slug ?>_index_start</pre></td>
			<td>
				Filter to modify the index of where to start processing. Default is <b>0</b>
			</td>
		</tr>

		<tr class="alternate">
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

		<tr class="alternate">
			<td><pre>fe_ajx_<?php echo $instance_slug ?>_process</pre></td>
			<td>
				Filter to modify the returned object when an item is processed.  Default is
<pre>
array(
	'success' => true,
	'index'   => $index,
	'persist' => array(),
)
</pre>
			</td>
		</tr>

		<tr class="alternate">
			<td><pre>fe_ajx_<?php echo $instance_slug ?>_process</pre></td>
			<td>Filter to modify the number of items to be processed</td>
		</tr>

		<tr>
			<td><pre>fe_ajx_<?php echo $instance_slug ?>_template_after</pre></td>
			<td>Action to display after the content on admin page.</td>
		</tr>

	</table>
