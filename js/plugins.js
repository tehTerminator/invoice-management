jQuery.fn.updateForm = function(){
	"use strict";

	var input = this.find("[name]"),
		source = global[this.attr("data-source")];

	input.each(function(){
		"use strict";
		var modal = jQuery(this).attr("name");
		if( modal.indexOf("_") >= 0 )
			modal = modal.split("_")[2]
		if( jQuery(this).attr("type") == "checkbox" ){
			var parent = jQuery(this).closest(".ui.checkbox");
			if( source.data[ source['selectedIndex'] ][modal] == 1 ){
				parent.checkbox("check");
			}
		}
		jQuery(this).val( source.data[ source['selectedIndex'] ][modal] );
	});

	return 1;
}

jQuery.fn.clearTable = function(){
	"use strict";
	tbody = this.find('tbody')[0];

	while( tbody.firstChild ){
		tbody.removeChild( tbody.firstChild );
	}

	return 1;
}

jQuery.fn.fillTable = function(){
	"use strict";
	var headerRow = this.children("thead").children("tr").children(),
	controller = {};

	controller.cellCount = headerRow.length;
	var source = global[this.attr("data-source")],
	tbody = this.find("tbody")[0];

	if( source == null ) return;
	else source = source.data;


	//Stores data type that is to be applied per column
	if( this.attr("data-type") == "autoFill" ){
		for( var i = 0; i < controller.cellCount; i++ ){
			controller[i] = {};

			var modal = headerRow.eq(i).attr("data-modal").split("|");

			controller[i]["modal"] = modal[0];

			if( modal[1] == undefined )
				controller[i]["format"] = "str"
			else
				controller[i]["format"] = modal[1];
		}
	}
	else{
		log("Table Formatting not Enabled, Script Now Exiting");
		return;
	}

	log( controller );

	if( source == undefined || source.length == 0 ) return;

	//Fills data in Table using format stored in controller and data in source
	for(var i=0; i < source.length; i++){
		var row = jQuery(document.createElement("tr"));
		row.attr("data-index", i);
		for(var j=0; j < controller["cellCount"]; j++){
			var cell = document.createElement("td"),
				format = global.format[controller[j]['format']],
				modal = source[i][controller[j]['modal']] == undefined ? controller[j]['modal'] : source[i][controller[j]['modal']],
				data = format( modal );
			if( typeof(data) !== "object"){
				cell.innerHTML = data ;
			}
			else{
				cell.appendChild( data );
			}
			row.append(cell);
		}
		tbody.appendChild(row[0]);
	}

	if( this.attr("data-sortable") == "true" && source != undefined && source.length > 0 )
		this.DataTable();

	log("Table Loaded Sucessfully");
	return;
}

jQuery.fn.getFormSettings = function(){
	"use strict";
	var myForm = this,
	link = myForm.attr("data-action"),
	blurError = myForm.attr("data-inline") === undefined ? true : false;

	return {
        inline: blurError,
        on: 'blur',
        onSuccess: function() {
            var data = myForm.serialize();
            jQuery.post(link, data, function(d) {
                global.message = JSON.parse(d);
                if( myForm.attr("data-success") === "reset" || myForm.attr("data-success") === undefined )
                	myForm[0].reset();
                else
                	myForm.setReadOnly();
            });
            //Prevent Page Refresh after Posting Data
            return false;
        }
    };
}

jQuery.fn.setReadOnly = function(){
	this.find("input, textarea").each(function(){
		jQuery(this).attr("readonly", "readonly");
	});
}
