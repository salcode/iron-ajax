jQuery(document).ready( function($) {

	// test
	var itemTotal, // set in AjaxInitSuccess
		itemIndex = 0, // overriden in AjaxInitSuccess
		batchSize = 1, // overridden in AjaxInitSuccess
		itemsBeingProcessed = [],
		ajaxUrl = ajaxurl,
		persist, // variable to maintain state between calls
		$domStatusCounter;

	$('#fe-data-process-start-button').on( 'click', function(e) {
		var data = {
			'action': 'fe_ajx_action',
			'instance_id': feAjx.instance_id,
			'nonce': feAjx.nonce,
			'step': 'init'
		};
		jQuery.ajax( {
			'dataType': "json",
			'data':     data,
			'type':     'post',
			'url':      ajaxUrl,
			'context':  this,
			'nonce': feAjx.nonce,
			'success':  ajaxInitSuccess
		} );

		e.preventDefault();
	});

	function ajaxInitSuccess( data, textStatus, jqXHR ) {
		itemTotal = data.entries_count;
		batchSize = data.batch_size;
		itemIndex = data.index_start;

		$('#fe-data-process-progressbar').progressbar({ max: itemTotal, value: 0 });
		updateTotal( itemTotal );
		processNext();
	}

	function ajaxBatchSuccess( data, textStatus, jqXHR ) {
		var lastIndex;
		$.each( data.results, function( key, value ) {
			lastIndex = key;
		} );

		updateStatus( itemIndex );
		itemsBeingProcessed = [];

		persist = data.results[ lastIndex ]['persist'];

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
			'action': 'fe_ajx_action',
			'step': 'batchprocess',
			'instance_id': feAjx.instance_id,
			'persist': persist,
			'nonce': feAjx.nonce,
			'itemsBeingProcessed': itemsBeingProcessed
		};

		jQuery.ajax( {
			'dataType': "json",
			'data':     data,
			'type':     'post',
			'url':      ajaxUrl,
			'context':  this,
			'nonce': feAjx.nonce,
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
		//console.log( "Completed" );
	}

	function complete() {

		var data = {
			'action': 'fe_ajx_action',
			'step': 'end',
			'nonce': feAjx.nonce,
			'instance_id': feAjx.instance_id
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
