$(document).ready(function() { initialize(); });

function initialize() { 
	prepareCfgDatepickers();
}

function prepareCfgDatepickers() {
	$('input[id^="dt"]').each(function() { 
		$(this).datepicker(
			{ onClose: function(dateText, inst) { 
					if (dateText!='') {
						$(this).next().val('00:00:00');
					} else {
						$(this).next().val('');
					}
				}, 
			  dateFormat: 'yy-mm-dd',
			  showButtonPanel: false
			}
		); 
	});
} 