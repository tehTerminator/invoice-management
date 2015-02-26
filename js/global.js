var global = {
	"format" : {
		"str" : function( s ){ return s; },
 		"currency" : function( n ){ return "<i icon rupee></i>" + Number(n).toFixed(2); },
 		"deleteBtn" : function(){
			delBtn = createElement({"tag" : "button", "class" : "ui red icon delete button", "onclick":"delBtnPress(this)"});
			delBtn.append( createElement({"tag": "i", "class":"icon remove"}));
			return delBtn[0];
		},
		"selectBtn" : function( event ){
			editBtn = createElement({"tag": "button", "class":"ui blue icon select button", "onclick":event+"(this)"});
			editBtn.append( createElement({"tag": "i", "class":"icon arrow right"}) );
			return editBtn[0];
		},
		"checkmark" : function(n){
			var i = createElement({"tag": "i", "class":"icon"});
			if( n == 1 )
				i.addClass("checkmark");
			else
				i.addClass("remove");

			return i[0];
		},
		"decimal" : function( n ){ return Number(n).toFixed(2); },
		"calc" : function(){
			var tokens = tokanize( arguments[0] ),
				symbolTable = arguments[1],
				i = 0,
				eq = "";

			for( i = 0; i < tokens.length; i++ ){
				if( symbolTable[ token[i] ] !== undefined )
					tokens[i] = symbolTable[ token[i] ];
				eq += token[i];
			}

			return eval( eq );
		}
	},
	"server" : {
		"queue" : [],
		"execute" : function(){
			if( global['server']['queue'].length == 0 ){
				global['server']['isRunning'] = false;
				var extraTime = setTimeout( function(){
					if( global['server']['queue'] == 0 ){
						global['server']['name'] = "Please Wait While We Load Things Up...";
						hideMainLoader();
					}
				}, 2000);
				return;
			}
			else{
				var a = global['server']['queue'].pop();
				global['server']['isRunning'] = true;
				setTimeout( function(){
					if( typeof(a) === 'function' ) a();
					else eval(a);
					updateLoader();
					global['server']['execute']();
				}, 1000 );
			}
		},
		"isRunning" : false,
		"name" : "Please Wait While We Load Things Up."
	},
	"tasks" : [
		initControls,
		fillAllTables,
		initForms,
		initTabs
	],
	"customers" : {
		"data" : [],
		"selectedIndex" : 0,
		"hash" : {}
	},

	"invoices" : {
		"data" : [],
		"selectedIndex" : 0,
		"hash" : {}
	},

	"products" : {
		"data" : [],
		"selectedIndex" : 0,
		"hash" : {}
	},

	"transactions" : {
		"data" : [],
		"selectedIndex" : 0,
		"hash" : {}
	},

	"accounts" : {
		"data" : [],
		"selectedIndex" : 0,
		"hash" : {}
	},
	"copier" : {
		"data" : [],
		"selectedIndex" : 0,
		"hash" : {}
	},
	"templateRows" : {

	},
	"message" : {

	},
	"clearCachedData" : function( target ){
		global[target].data = [];
		global[target].hash = {};
		global[target].selectedIndex = -1;
	}
};
