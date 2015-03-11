jQuery(document).ready(function(){
	jQuery("nav > a").click(function(){
		showMainLoader();
		var link = "ui/" + jQuery(this).attr("data-link");
		jQuery("#main").load( link );

		var s = link.split(".")[0].substr(3) + ".js";

		jQuery.getScript("js/extra/" + s, function(){
			log(s + " loaded Sucessfully");
		});

		jQuery("nav > a.active").removeClass("active");
		jQuery(this).addClass("active");
	});

	jQuery("nav > a").eq(0).addClass("active");

	jQuery(".ui.sticky").sticky();

	jQuery("#smallModal").modal({
		closable : false
	});
});

