jQuery(document).ready( function($) {

	// test
	var itemTotal, // set in AjaxInitSuccess
		itemIndex = 0, // overriden in AjaxInitSuccess
		batchSize = 1, // overridden in AjaxInitSuccess
		itemsBeingProcessed = [],
		itemsCompleted = [],
		itemsFailed = [],
		ajaxUrl = ajaxurl,
		$domStatusCounter;

	$('#fe-data-process-start-button').on( 'click', function(e) {
		var data = {
			'action': 'fe_ajx_action',
			'instance_id': feAjx.instance_id,
			'step': 'init'
		};
		jQuery.ajax( {
			'dataType': "json",
			'data':     data,
			'type':     'post',
			'url':      ajaxUrl,
			'context':  this,
			'success':  ajaxInitSuccess
		} );

		console.log( 'process start button clicked' );
		e.preventDefault();
	});

	function ajaxInitSuccess( data, textStatus, jqXHR ) {
		console.log( data );
		itemTotal = data.total_entries;
		batchSize = data.batch_size;
		itemIndex = data.item_index_start;

		$('#fe-data-process-progressbar').progressbar({ max: itemTotal, value: 0 });
		updateTotal( itemTotal );
		processNext();
	}

	function ajaxBatchSuccess( data, textStatus, jqXHR ) {
		console.log( 'ajaxBatchSuccess' );
		console.log( data );
		$.each( data.results, function( key, value ) {
			console.log( key + ' ' + value );
			if ( 'success' === value ) {
				itemsCompleted.push( key );
			} else if ( 'failure' === value ) {
				itemsFailed.push( key );
			}
		} );

		updateStatus( itemIndex );
		itemsBeingProcessed = [];

		processNext();
	}

	function processNext() {
		var counter = 0,
			data;

		while (
			counter < batchSize
			&& itemIndex < itemTotal
		) {
			itemsBeingProcessed.push( itemIndex );
			itemIndex++;
			counter++;
		}

		if ( !itemsBeingProcessed.length ) {
			complete();
			return;
		}

		data = {
			'action': 'fe_data_process_batch',
			'itemsBeingProcessed': itemsBeingProcessed
		};
		console.log( itemsBeingProcessed );
		console.log( data );

		jQuery.ajax( {
			'dataType': "json",
			'data':     data,
			'type':     'post',
			'url':      ajaxUrl,
			'context':  this,
			'success':  ajaxBatchSuccess
		});

	}

	function updateStatus( numberProcessed ) {
		if ( !$domStatusCounter ) {
			$domStatusCounter = $('#fe-data-process-counter' );
		}

		$( "#fe-data-process-progressbar" ).progressbar( "option", "value", numberProcessed );
		$domStatusCounter.text( numberProcessed );
	}

	function updateTotal( numberTotal ) {
		$('#fe-data-process-total').text( numberTotal );
	}

	function ajaxCompleteSuccess( data, textStatus, jqXHR ) {
		console.log( data );
		console.log( "Completed" );
	}

	function complete() {
		console.log( 'complete() done processing' );

		var data = {
			'action': 'fe_data_process_complete'
		};

		jQuery.ajax( {
			'dataType': 'json',
			'data': data,
			'type': 'post',
			'url':  ajaxUrl,
			'context': this,
			'success': ajaxCompleteSuccess
		});

	}



});
