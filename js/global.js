var global = {
	"format" : {
		"str" : function( arg ){ return arg.data; },
 		"currency" : function( arg ){ return "<i class='icon rupee'></i>" + Number(arg.data).toFixed(2); },
 		"deleteBtn" : function( arg ){
			delBtn = createElement({"tag" : "button", "class" : "ui red icon delete button", "onclick":arg.data});
			delBtn.append( createElement({"tag": "i", "class":"icon remove"}));
			return delBtn;
		},
		"selectBtn" : function( arg ){
			editBtn = createElement({"tag": "button", "class":"ui blue icon select button", "onclick":arg.data});
			editBtn.append( createElement({"tag": "i", "class":"icon arrow right"}) );
			return editBtn;
		},
		"checkmark" : function(arg){
			var i = createElement({"tag": "i", "class":"icon"});
			if( arg.data == 1 )
				i.addClass("checkmark");
			else
				i.addClass("remove");

			return i;
		},
		"decimal" : function( arg ){ return Number(arg.data).toFixed(2); },
		"eval" : function(arg){
			var sourceTable = arg.location,
				expression = arg.data,
				symbolTable = arg.source,
				hasVariable = false,
				variable = null;

			if( has(expression, "=") ){
				variable = arg.data.split("=")[0];
				expression = arg.data.split("=")[1];
			}

			var tokens = tokanize( sourceTable, expression )
				i = 0,
				eq = "";

			if( global.cache[ sourceTable ]['var_index'] !== undefined ){
				//if data exist in cache
				//Might improve performance for equation with many variables
				for( var b in global.cache[ sourceTable ]['var_index'] ){
					if( has(tokens[b], "_") ){
						token[b] = token[b].split("_")[1];
					}
					tokens[b] = symbolTable[ tokens[b] ];
				}
				//Replace ',' in equation so that expression can be evaluated.
				eq = tokens.join().replace(/,/g,"");
			}
			else{
				global.cache[ sourceTable ]['var_index'] = {};
				//Replace variables with value
				//Stores location of variables in cache for further usage
				for( i = 0, l = tokens.length; i < l; i++ ){
					if( symbolTable[ tokens[i] ] !== undefined ){
						global['cache'][sourceTable]['var_index'][i] = tokens[i];
						tokens[i] = symbolTable[ tokens[i] ];
					}
					eq += tokens[i];
				}
			}

			var answer = eval(eq);

			if( variable !== null ) symbolTable[variable] = answer;

			if( arg['format2'] !== undefined ) 
				return global['format'][arg['format2']]( {"data":answer} );

			return answer;
		},
		"query" : function(arg){
			var expression = arg.data,
				symbolTable = arg.source,
				variable = expression.split("_")[1],
				target = expression.split("_")[0],
				id = symbolTable[target + "_id"];

			try{
				symbolTable[variable] = global[target + "s"]["data"][id][variable];
			} catch(e){
				symbolTable[variable] = expression;
			}


			if( arg['format2'] !== undefined ) 
				return global['format'][arg['format2']]( {"data":symbolTable[variable]} );

			return symbolTable[variable]
		}
	},
	"server" : {
		"queue" : [],
		"execute" : function(){
			showMainLoader();

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
	"templateRows" : {

	},
	"messages" : {},
	"clearCachedData" : function( target ){
		if( global[target] !== undefined ){	
			global[target]['data'] = {};
			global[target]['selectedIndex'] = -1;
		}
	},
	"cache" : {
		"lastIndex" : 0
	},
	"getIndex" : function(){ return global.cache.lastIndex++; },
	"sum" : function( arg ){
		source = arg.source;
		var total = 0,
		len = source.length,
		i = 0;

		for( var i in source ){
			total += Number( source[i][arg['data']] );
		}

		if( arg['format2'] !== undefined ) 
			return global['format'][arg['format2']]( {"data":total} );

		return total;
	},
	"clearSelected" : function( location ){
		global[location]['selectedIndex'] = -1;
	},
	"makeSelection" : function( location, id ){
		global[location].selectedIndex = id;
		var selected = global[location]['data'][id];
		for( var key in selected ){
			if( has(key, "id") && has(key, "_") ){
				var target;

				try{	
					target = key.split("_")[0] + "s";
					global.makeSelection( target, selected[key] );
				} catch(e){
					console.log("Error Was Encountered while Selecting " + key + " " + e.toString() );
				}
				
			}
		}
		return;
	},
	"save" : function(location, data){
		location = global[location];

		if( location['min'] === undefined ){
			location['min'] = Number(data[0]['id']);
			location['max'] = 0;
		}

		for(var i=0; i < data.length; i++){
			location['data'][data[i]['id']] = data[i];

			if( location['min'] > Number( data[i]['id'] ) )
				location['min'] = Number( data[i]['id'] );
			if( location['max'] < Number( data[i]['id'] ) )
				location['max'] = Number( data[i]['id'] )
		}
	}
};
