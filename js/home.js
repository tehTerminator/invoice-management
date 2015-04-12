jQuery(document).ready(function(){

	jQuery("nav > a").tab({
		"path" : "ui/",
		"auto" : true,
		'onTabLoad' : function(){
			loadScript();
		},
		'history' : true,
		'historyType' : 'hash'
	});

	jQuery(".ui.sticky").sticky();

	jQuery("#smallModal").modal({
		closable : false
	});
});

function loadScript(){

	setTimeout(function(){
		var link = document.location.toString().split("/");
		scriptName = link[link.length - 1];

		var s = scriptName.split(".")[0] + ".js";

		if( has( document.location.href, ".php" ) ){
			jQuery.getScript("js/extra/" + s, function(){
				log(s + " loaded Sucessfully");
			});				
		} else{
			jQuery.getScript("js/extra/dashboard.js", function(){
				log( "dashboard.js loaded Successfully" );
			});
		}
	}, 1000);
}

