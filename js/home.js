$(document).ready(function(){
	$("nav > a").click(function(){
		showMainLoader();
		var link = "ui/" + $(this).attr("data-link");
		$("#main").load( link );

		var s = link.split(".")[0].substr(3) + ".js";

		jQuery.getScript("js/extra/" + s, function(){
			log(s + " loaded Sucessfully");
		});

		$("nav > a.active").removeClass("active");
		$(this).addClass("active");
	});

	jQuery("nav > a").eq(0).addClass("active");
});