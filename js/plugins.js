jQuery.fn.updateForm = function(){
	"use strict";

	if( jQuery(this).attr("data-source") === undefined ){
		var fields = jQuery(this).find("[data-source]");

		fields.each(function(){
			jQuery(this).updateForm();
		});
	} else{

		var source = global[jQuery(this).attr("data-source")],
			locations = jQuery(this).find("[name]");

		locations.each(function(){
			jQuery(this).updateField( source['data'][ source['selectedIndex'] ] );
		});
	}
}

jQuery.fn.updateField = function(source){
	"use strict";

	try{
		var modal = this.attr("name");
		if( jQuery(this).attr("type") === "checkbox" ){
			var parent = jQuery(this).closest(".ui.checkbox");
			if( source[modal] == 1 ){
				parent.checkbox("check");
			}
		}

		this.val( source[modal] );	
	} catch(e){
		return;
	}
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
	jQuery(this).clearTable();

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
	for(var i in source){
		var row = createElement({tag:'tr', 'data-index' : i});
		for(var j=0; j < controller["cellCount"]; j++){
			var cell = createElement({tag:'td'}),
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

			cell.append(data);
			row.append(cell);
		}
		tbody.appendChild(row[0]);
	}

	var tfoot = this.find("tfoot")

	if( tfoot != undefined && tfoot.find("[data-model]").length > 0 ){
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
	} else{
		var tfoot = createElement({tag:'tfoot'});
		jQuery(this).append( tfoot );
		tfoot.append( jQuery(this).find("thead").children().clone() );
	}

	if( this.attr("data-sortable") == "true")
		this.DataTable();
	
	return 1;
}

jQuery.fn.getFormSettings = function(){
	"use strict";
	var myForm = jQuery(this),
	link = myForm.attr("data-action");

	var setting = {};

	setting.form = {}
	

	return {
        inline: true,
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

                myForm[0].reset();

                if( has(link, "add") || has(link, "update") ){
                	//If Data is added or Updated 
                	var id = global.message.lastInsertId;
                	load( link.split("=")[1] + "|id=" + id );
                }
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

