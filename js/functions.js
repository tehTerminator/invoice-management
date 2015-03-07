function setTask( name ){
	global.server.current = name;
}

function showMainLoader(){
	"use strict";
	jQuery("main > .ui.dimmer").addClass("active");
}

function updateLoader(){
	"use strict";
	if( ! jQuery("main > .ui.dimmer").hasClass("active") )
		showMainLoader();

	jQuery("#task").html( global.server.current );
	// jQuery("#completed").html( global['server']['completedTasks']);
	// jQuery("#totalTask").html( global['server']['totalTasks']);
}

function hideMainLoader(){
	"use strict";
	jQuery("main > .ui.dimmer").removeClass("active");
}

function loadPage(pageName){
	"use strict";
	showMainLoader();
	jQuery("#main").load(pageName);
}

function initTabs(){
	"use strict";
	setTask("Initializing Tabs");

	//Hiding All Tabs other than First Tab
	jQuery(".ui.tabular.menu")
		.next(".ui.bottom.attached.segment")
		.children(".ui.basic.segment:not(:first-child)").hide();

	jQuery(".menu > .item").on('click', function(){

		if( jQuery(this).hasClass("active") ){
			return;
		}

		if( jQuery(this).parent().hasClass("tabular") ){
			//Changes Tab if Tabular Menu item is clicked
			var index = jQuery(".ui.tabular.menu > a").index( jQuery(this) );

			jQuery(this).parent()
				.next(".ui.bottom.attached.segment")
				.children(".ui.basic.segment").hide()
				.eq(index).slideDown('slow');
		}

		if( jQuery(this).attr("data-action") !== undefined ){
			home['actions'][ jQuery(this).attr("data-action") ]();
		}

		//Activate the Menu
		jQuery(this).parent()
			.children(".active")
			.removeClass("active");
		jQuery(this).addClass("active");

	});
}

function initControls(){
	"use strict";

	setTask("Initializing Controls")

	jQuery("[data-prev]").hide();

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
	source = (jQuery(me).closest("table").attr("data-source")),
	i = global[source][index].id,
	link = "php/deleteData?t=" + source;

	jQuery.ajax({
			url: link,
			type: 'post',
			data: { "id" : i },
			success: function (data) {
				jQuery(me).closest("tr").slideUp('slow').remove();
			}
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
	source.selectedIndex = index;

	target = "[data-source='" + target + "']";
	jQuery("#" + next).find(target).each(function(){
		jQuery(this).updateForm();
	});
}


function initForms(){
	"use strict";

	setTask( "Initializing Forms" );

	var forms = jQuery(".form.segment[data-validation='true']");

	for( var i=0; i<forms.length; i++){
		var validationRule = {},
		myForm = forms.eq(i),
		elements = myForm.find("input[data-required='true'], textarea[data-required='true']");
		for(var j=0;j<elements.length;j++){
			var currElement = elements.eq(j);

			validationRule[ currElement.attr("name") ] = {
				identifier : currElement.attr("name"),
				rules : [{
					type : "empty",
					prompt : "Please Enter " + currElement.prev("label").text()
				}]
			};

			var rules = currElement.attr("data-rules");
			if( rules === undefined )
				continue;

			rules = rules.split(" ");
			for(var k=0; k< rules.length;k++){
				if( rules[k] == "empty")
					continue;
				else{
					validationRule[currElement.attr("name")].rules.push({
						type : rules[k],
						prompt : "Please Enter Valid " + currElement.prev("label").text()
					})
				}
			}
		}
		myForm.form( validationRule, myForm.getFormSettings() );
	}
}



function log( message ){
	"use strict";
	console.log( message );
}

function createElement( s ){
	"use strict";
	var a = jQuery( document.createElement(s.tag));
	a.html( s["html"] );
	a.addClass( s["class"] )
	delete s["tag"];
	delete s["html"];
	delete s["class"];
	for( var attr in s ){
		a.attr(attr, s[attr] );
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

		for(var i=0; i < source.length; i++){
			var item = createElement({
				"tag" : "div",
				"class" : "item",
				"data-value" : source[i]['id'],
				"html" : source[i]['name']
			});
			menu.append(item);
		}

	});
}

function fillAllTables(){
	"use strict";

	setTask("Inserting Data in Tables.");

	jQuery(".ui.table.segment").each(function(){
		"use strict";
		if( jQuery(this).attr("data-type") == "autoFill" ){
			jQuery(this).fillTable();
		}
	});
}

function executeTasks( list ){
	"use strict";

	if( global['server']['isRunning'] ){
		setTimeout( function(){
			executeTasks( list );
		}, 1000);
	}
	else{
		for( var i =0; i < list.length ; i++ ){
			global['server']['queue'].unshift(list[i]);
		}
		global['server']['execute']();
	}

	global['server']['totalTasks'] = global['server']['queue'].length;
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

function crunchData( source ){
	for( var i = 0; i < source.data.length; i++ ){
		source['hash'][source.data[i].id] = source.data[i];
	}
}

function load( arg ){
	"use strict";
	var param = {};
	arg = arg.split("|");
	var source = global[arg[0]],
	link = "php/getData.php?t=" + arg[0],
	currentTime = new Date();

	if( source.createdOn !== undefined && currentTime - source.createdOn < 120000 )
		return;

	setTask("Loading " + arg[0].toUpperCase());

	jQuery.ajax({
			url: link,
			type: 'get',
			data: {
				'limit' : arg[1] == undefined ? 0 : arg[1],
				'orderby' : arg[2] == undefined ? "name" : arg[2].split(".")[0],
				'ordertype' : arg[2] == undefined ? "DESC" : arg[2].split(".")[1],
				'id' : arg[3] == undefined ? "" : arg[3]
			},
			success: function (data) {
				source['data'] = JSON.parse(data);
				setTimeout( function(){
					crunchData( source );
				}, 2000)
			}
		});

	source.createdOn = currentTime;
}

function autoload(arg){
	var q = []
	for(var i=0; i<arg.length;i++){
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
        symbol = "";

    for(i = 0; i < expression.length; i++){
    	var c = expression[i];
    	if( has(operators, c)  ){
    		stack1.push(c);
    	}
    	else if( has(characters, c) ){
    		while( !( has(operators,c) || c === ")" || i === expression.length ) ){
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

/**
* @description Finds a character in String
* @return Boolean
*/
function has( some_string, character){
	return some_string.indexOf(character) !== -1
}
