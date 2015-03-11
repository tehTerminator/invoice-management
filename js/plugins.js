jQuery.fn.updateForm = function(){
	"use strict";

	var input = this.find("[name]"),
		source = global[this.attr("data-source")];

	input.each(function(index){
		"use strict";
		var modal = jQuery(this).attr("name");
		if( modal.indexOf("_") >= 0 )
			modal = modal.split("_")[1]
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
	var tbody = this.find('tbody')[0];

	while( tbody.firstChild ){
		tbody.removeChild( tbody.firstChild );
	}

	var id = this.attr("id");

	for( var table in global.cache ){
		if( has(table, id) ){
			delete global['cache'][table];
		}
	}

	return 1;
}

jQuery.fn.fillTable = function(){
	"use strict";
	var headerRow = this.children("thead").children("tr").children(),
	controller = {},
	tableId = this.attr("id");

	if( tableId === undefined ){
		this.attr("id", global.getIndex() );
		tableId = this.attr("id");
	}

	controller.cellCount = headerRow.length;
	var source = global[this.attr("data-source")],
	tbody = this.find("tbody")[0];

	if( source == null ) return;
	else source = source.data;


	//Stores data type that is to be applied per column
	if( this.attr("data-type") == "autoFill" ){
		for( var i = 0; i < controller.cellCount; i++ ){
			controller[i] = {};

			var args = headerRow.eq(i).attr("data-model").split("|");

			controller[i]["modal"] = args[0];

			if( args[1] == undefined )
				controller[i]["format"] = "str";
			else{
				controller[i]["format"] = args[1];
			}

			if( args[2] !== undefined ){
				controller[i]['format2'] = args[2];
			}
		}
	}
	else{
		log("Table Formatting not Enabled, Script Now Exiting");
		return;
	}

	if( source == undefined || source.length == 0 ) return;

	//Fills data in Table using format stored in controller and data in source
	for(var i=0; i < source.length; i++){
		var row = jQuery(document.createElement("tr"));
		row.attr("data-index", i);
		for(var j=0; j < controller["cellCount"]; j++){
			var cell = document.createElement("td"),
				format = global['format'][controller[j]['format']],
				modal = {},
				data = null;

				modal['data'] = source[i][controller[j]['modal']] === undefined ? controller[j]['modal'] : source[i][controller[j]['modal']];
				modal['source'] = source[i];
				modal['location'] = tableId + "&&" + j;

				if( controller[j]['format2'] !== undefined ){
					if( has(["str", "currency", "decimal"], controller[j]['format2'] ) ){
						modal['format2'] = controller[j]['format2'];
					}
				}

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

	var tfoot = this.find("tfoot")

	if( tfoot.find("[data-model]").length > 0 ){
		var	c = tfoot.find("[data-model]"),
			fn = c.attr("data-model").split("|")[1],
			variable = c.attr("data-model").split("|")[0];

		var arg = {};

		arg['model'] = fn;
		arg['data'] = variable;
		arg['format2'] = c.attr("data-model").split("|")[2];
		arg['source'] = source;

		var result = global[fn](arg);

		c.html( result );
	}

	if( this.attr("data-sortable") == "true" && source != undefined && source.length > 0 )
		this.DataTable();
	
	return 1;
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
            	try{
            		global.message = JSON.parse(d);
            	}
            	catch(e){
            		global.message = d;
            	}
                
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
	//Make all input and Text Area Readonly
	this.find("input, textarea").each(function(){
		jQuery(this).attr("readonly", "readonly");
	});
}
