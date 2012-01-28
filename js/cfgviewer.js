$(document).ready(function() { initialize(); });

function initialize() { 
	prepareCfgDatepickers();
	prepareDialogs();
	$('#cfg_table').tablesorter({headers: { 10: { sorter:false}}, sortList: [[1,0],[2,0],[3,0]]});
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

function prepareDialogs() { 
	$('#cfg_dialog_addlink').click( function() { resetCfgDialog("add", 0); $('#cfg_dialog').show(); });
	$('#cfg_dialog_reset').click( function() { resetCfgDialog("add", 0); });
	$('#cfg_dialog_close').click( function() { $('#cfg_dialog').hide(); });
	prepareTableRowEdit();
}

function resetCfgDialog(mode, id) { 
	if (mode=="add") {
		$('#cfg_form').attr('action','include/cfg_engine.php?action=addcfg')[0].reset();
		$('input[type="submit"]').val('Add'); 
		$('#cfg_dialog legend').html('Add a configuration');
		$('button[type="reset"]').show();
	} else if (mode=="edit") {
		$('#cfg_form').attr('action','include/cfg_engine.php?action=editcfg&id='+id+'');
		$('input[type="submit"]').val('Update');
		$('#cfg_dialog legend').html('Update a configuration');
		$('button[type="reset"]').hide();
	}
}

function prepareTableRowEdit() {
	$('#cfg_table td').click(function() {
		var thisid = $(this).siblings(':first').html();
		$.post("include/cfg_engine.php?action=getcfg", { cfgid : thisid }, function(o) {
			$('input[type="text"]').each(function() {
				if (o[0][$(this).attr('name')]!="") { // as long as the value isn't blank
					$(this).val(o[0][$(this).attr('name')]); // add it to the appropriate field
				}
			});
			$('input[name="locked"]').eq(o[0]['locked']).attr('checked',true);
			resetCfgDialog("edit", thisid);
			$('#cfg_dialog').show();
		}, "json");
	});
}
