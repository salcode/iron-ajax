<div class="wrap">
	<h2><?php echo apply_filters( "fe_ajx_{$instance_slug}_template_heading", $this->args['page_title'], $instance_id ); ?></h2>

	<?php do_action( 'fe_ajx_template_before', $instance_id ); ?>

	<p>
		<input id="fe-data-process-start-button" type="submit"
			class="button hide-if-no-js" name="fe-data-process"
			id="fe-data-process" value="<?php _e( 'Start Processing Data', 'iron-ajax' ); ?> ">

		<!--
		<input id="fe-data-process-stop-button" type="submit"
			class="button hide-if-no-js" name="fe-data-stop"
			id="fe-data-stop" value="<?php _e( 'Stop Processing Data', 'iron-ajax' ); ?> ">

		<input id="fe-data-process-pause-button" type="submit"
			class="button hide-if-no-js" name="fe-data-pause"
			id="fe-data-pause" value="<?php _e( 'Pause Processing Data', 'iron-ajax' ); ?> ">

		<input id="fe-data-process-resume-button" type="submit"
			class="button hide-if-no-js" name="fe-data-resume"
			id="fe-data-resume" value="<?php _e( 'Resume Processing Data', 'iron-ajax' ); ?> ">
		-->

	</p>

	<noscript><p><em><?php _e( 'You must enable Javascript in order to proceed!', 'iron-ajax' ) ?></em></p></noscript>
	<div id="fe-data-process-progressbar"></div>

	<p>
		Processing <span id="fe-data-process-counter">0</span> out of <span id="fe-data-process-total">many</span>
	</p>

	<?php do_action( "fe_ajx_{$instance_slug}_template_after",
		$instance_id,
		$instance_slug
	); ?>

</div>
