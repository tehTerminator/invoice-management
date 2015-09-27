jQuery(document).ready(function(){

	jQuery("nav > a").tab({
		"path" : "ui/",
		"auto" : true,
		'onLoad' : function(){
			var link = jQuery(this).attr("data-tab").split(".")[0] + ".js";
			jQuery.getScript("js/extra/" + link);
		},
		'history' : true,
		'historyType' : 'hash',
		'cache' : true
	});

	jQuery(".ui.sticky").sticky();

	jQuery("#smallModal").modal({
		closable : false
	});
});

