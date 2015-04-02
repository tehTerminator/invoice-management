jQuery(document).ready(function(){

	jQuery("nav > a").tab({
		"path" : "ui/",
		"auto" : true,
		'onTabLoad' : function(){
			showMainLoader();
			var link = document.location.toString().split("/");
				scriptName = link[link.length - 1];

			var s = scriptName.split(".")[0] + ".js";

			if( s.length > 0 )
				jQuery.getScript("js/extra/" + s, function(){
					log(s + " loaded Sucessfully");
				});
		},
		'history' : true,
		'historyType' : 'hash'
	});

	jQuery(".ui.sticky").sticky();

	jQuery("#smallModal").modal({
		closable : false
	});
});

