var global = {
	"format" : {
		"str" : function( s ){ return s; },
 		"currency" : function( n ){ return "<i icon rupee></i>" + Number(n).toFixed(2); },
 		"deleteBtn" : function( event ){
			delBtn = createElement({"tag" : "button", "class" : "ui red icon delete button", "onclick":event+"(this)"});
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
		"eval" : function(args){
			var sourceTable = args[0],
				expression = args[1],
				symbolTable = args[2],
				hasVariable = false;

			var tokens = tokanize( sourceTable, expression )
				i = 0,
				eq = "";

			if( global.cache[ sourceTable ]['var_index'] !== undefined ){
				//if data exist in cache
				//Might improve performance for equation with many variables
				for( var b in global.cache[ sourceTable ]['var_index'] ){
					tokens[b] = symbolTable[ tokens[b] ];
				}
				//Replace ',' in equation so that they can be evaluated.
				eq = tokens.join().replace(/,/g,"");
			}
			else{
				global.cache[ sourceTable ]['var_index'] = {};
				//Replace variables with value
				//Stores location of variables in cache for further usage
				for( i = 0; i < tokens.length; i++ ){

					if( symbolTable[ tokens[i] ] !== undefined ){
						global['cache'][sourceTable]['var_index'][i] = tokens[i];
						tokens[i] = symbolTable[ tokens[i] ];
					}
					eq += tokens[i];
				}
			}

			if( global['cache'][sourceTable]['total'] === undefined ){
				global['cache'][sourceTable]['total'] = eval( eq );
			}
			else{
				global['cache'][sourceTable]['total'] = Number(global['cache'][sourceTable]['total']) + eval(eq);
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
					try{
						if( typeof(a) === 'function' ) a();
						else eval(a);
					}
					catch(e){
						log("Error was encountered while executing " + a );
						log(e);
					}
					finally{
						updateLoader();
						global['server']['execute']();
					}
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
	},
	"cache" : {
		"lastIndex" : 0
	},
	"getIndex" : function(){ return global.cache.lastIndex++; },
	"sum" : function( tableId, variable ){
		variable = Number(variable.slice(3)) - 1;
		return global['cache'][tableId + "&&" + variable]['total'];
	}
};
