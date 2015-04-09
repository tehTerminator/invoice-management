function setTask( name ){ global.server.current = name; }
function showMainLoader(){ jQuery(".active.tab").addClass("loading"); }
function updateLoader(){ jQuery("#task").html( global.server.current ); }
function hideMainLoader(){ jQuery(".active.tab").removeClass("loading"); }

/**
* @description Finds a character in String
* @return Boolean
*/
function has( some_string, character){
	return some_string.indexOf(character) !== -1
}

function initTabs(){
	jQuery(".ui.tabular.menu .item").tab();
}

function initControls(){
	jQuery(".back.button").on('click', function(){
			var parent = jQuery(this).closest("[data-prev]"),
			prevElement = parent.attr("data-prev");
			parent.hide();
			jQuery("#"+prevElement).show();
		}
	);

	jQuery(".ui.dropdown").dropdown();
	jQuery(".ui.checkbox").checkbox();

	jQuery(".ui.checkbox").on('change', function(){
		if( jQuery(this).checkbox('is checked') )
			jQuery(this).children("input").val(1);
		else
			jQuery(this).children("input").val(0);
	});
}

function delBtnPress(me){
	"use strict";
	var index = jQuery(me).closest("tr").attr("data-index"),
	source = jQuery(me).closest("table").attr("data-source"),
	link = "php/deleteData";

	jQuery.ajax({
			url: link,
			type: 'post',
			data: { "t" : source, "id" : index },
			dataType : 'json',
			success: function (data) { jQuery(me).closest("tr").slideUp('slow').remove(); }
		});

}

function selectBtnPress(me){
	"use strict";
	var index = jQuery(me).closest("tr").attr("data-index"),
		target = jQuery(me).closest("table").attr("data-source"),
		source = global[target],
		next = jQuery(me).closest("[data-next]").attr("data-next");
	jQuery(me).closest("[data-next]").hide();
	jQuery("#" + next).fadeIn('slow');
	global['makeSelection']( target, index );
	jQuery("#" + next).updateForm();
}

function initForms(){
	"use strict";

	setTask( "Initializing Forms" );

	var forms = jQuery(".form.segment[data-validation='true']");

	forms.each(function(){
		var validationRule = {},
		myForm = jQuery(this),
		elements = myForm.find("input[data-required='true'], textarea[data-required='true']");
		elements.each(function(){
			var currElement = jQuery(this);

			validationRule[ currElement.attr("name") ] = {
				identifier : currElement.attr("name"),
				rules : [{
					type : "empty",
					prompt : "Please Enter " + currElement.prev("label").text()
				}]
			};

			var rules = currElement.attr("data-rules");
			if( rules === undefined ) return;

			rules = rules.split(" ");
			for(var k in rules){
				if( rules[k] == "empty") continue;
				else{
					validationRule[currElement.attr("name")].rules.push({
						type : rules[k],
						prompt : "Please Enter Valid " + currElement.prev("label").text()
					})
				}
			}
		});
		myForm.form( validationRule, myForm.getFormSettings() );
	});
}



function log( message ){ console.log( message ); }

function createElement( s ){
	"use strict";
	var a = jQuery( document.createElement(s.tag) );
	delete s['tag'];
	for( var attr in s ){
		if( attr === "class" ) a.addClass( s['class'] );
		else if( attr === "html" ) a.html( s['html'] );
		else a.attr( attr, s[attr] );
	}

	return a;
}

function fillDropdown(){
	"use strict";
	setTask( "Initializing Dropdowns");

	jQuery(".ui.dropdown").each(function(){
		"use strict";
		if( jQuery(this).attr("data-source") == undefined )
			return;

		var source = global[ jQuery(this).attr("data-source") ].data,
			menu = jQuery(this).children(".menu");

		if( source == null ) return;

		for(var i in source){
			var item = createElement({
				"tag" : "div",
				"class" : "item",
				"data-value" : i,
				"html" : source[i]['name']
			});
			menu.append(item);
		}

	});
}

function feedback(header, statement, fn){
	jQuery("#modalContent").html( statement );
	jQuery("#modalHeader").html( header );
	jQuery("#smallModal").modal({ onApprove: fn });
	jQuery("#smallModal").modal('show');
}

function fillAllTables(){
	jQuery(".ui.table").each(function(){
		if( jQuery(this).attr("data-type") == "autoFill" ) jQuery(this).fillTable(); 
	});
}

function executeTasks( list ){
	"use strict";

	//Wait until Queue Is Empty
	if( global['server']['isRunning'] ){
		setTimeout( function(){
			executeTasks( list );
		}, 1000);
	}
	else{
		//Push Task inside Queue
		for( var i =0; i < list.length ; i++ ){
			global['server']['queue'].unshift(list[i]);
		}
		global['server']['execute']();
	}

	//global['server']['totalTasks'] = global['server']['queue'].length;
}

function initDynamicTables(){
	"use strict";
	setTask( "Initializing Dynamic Tables" );

	var counter = 1;
	jQuery(".ui.table[data-type='dynamic']").each(function(){
		"use strict";
		var templateRow = jQuery(this).find(".templateRow");
		templateRow.removeAttr("class");
		var source = global[jQuery(this).attr("data-source")];
		jQuery(this).attr("id", "d" + counter);
		source['d' + counter] = templateRow.clone();
		templateRow.remove();
		jQuery(this).find("tbody").append( source[jQuery(this).attr("id")].clone());
		counter++;
	});

	jQuery(".ui.dropdown").dropdown();

	jQuery(".ui.table[data-type='dynamic']")
		.find("button.green.button")
		.on('click', function(e){
			"use strict";
			e.preventDefault();
			var parent = jQuery(this).closest("table"),
				tbody = parent.children("tbody"),
				source = global[parent.attr("data-source")],
				newRow = source[ parent.attr("id") ].clone();

			tbody.append( newRow );

			jQuery(".ui.dropdown").dropdown();
		});

	jQuery(".ui.table[data-type='dynamic']")
		.find("button.red.button")
		.on('click', function(e){
			"use strict";
			e.preventDefault();
			var table = jQuery(this).closest("table"),
				tbody = table.find("tbody");

			if( tbody.children("tr").length == 1 )
				return
			else
				tbody.children("tr").eq(-1).remove();
		});
}

function load( arg ){
	"use strict";
	var param 		= {},
		arg 		= arg.split("|"),
		link 		= "php/getData.php",
		result 		= [],
		source 		= arg[0];

	if( global[source] === undefined ){
		global[source] = {
			data 			: {},
			selectedIndex 	: -1
		};
	}

	for( var i = 1, l = arg.length; i < l; i++){
		if( has(arg[i], "=") ){
			param[arg[i].split("=")[0]] = arg[i].split("=")[1];
		} 
		else if( has(arg[i], ".") ){
			param['orderby'] 	= arg[i].split(".")[0];
			param['ordertype'] 	= arg[i].split(".")[1];
		}
		else {
			param['limit'] = arg[i];
		}
	}

	param['t'] = arg[0];

	var availableData = Object.keys( global[source]['data'] ).length;

	if( availableData > 0 && Object.keys( param ).length === 1 ){
		param['condition'] = "id not between " + global[source]['min'] + " and " + global[source]['max'];
	}

	jQuery.ajax({
			url: link,
			type: 'get',
			data: param,
			dataType : "json",
			success: function (data) {
				result = data;
			}
		});

	setTimeout(function(){
		global.save( source, result );
	}, 2000);
}

function autoload(arg){
	var q = [];
	for(var i=0, l = arg.length; i<l;i++){
		q.unshift( "load('" + arg[i] + "')" );
	}
	executeTasks( q );
}

/**
* Breaks equation into tokens
* prevents direct execution of js expression
* for security purpose
* @return tokens<array>
*/
function tokanize( src, expression ){
	//Lookup expression in Cache
	if( global['cache'][src] !== undefined ) return global['cache'][src]['tokens'].slice();

	//Create location in Cache if not found in cache
	global['cache'][src] = {};

    var stack1 = [],
        i = 0,
        operators = "+-*/()",
        characters = "abcdefghijklmnopqrstuvwxyz_-0123456789.",
        symbol = "",
        len = expression.length;

    for(i = 0; i < len; i++){
    	var c = expression[i];
    	if( has(operators, c)  ){
    		stack1.push(c);
    	}
    	else if( has(characters, c) ){
    		while( !( has(operators,c) || c === ")" || i === len ) ){
    			symbol += c;
    			c = expression[++i];
    		}
			symbol = jQuery.trim( symbol );
    		stack1.push(symbol);
    		symbol = "";
    		--i;
    	}
	}

	//Store tokens in Cache
	global['cache'][src]['tokens'] = stack1.slice();
	return stack1;
}


