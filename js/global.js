var global = {
	"format" : {
		"str" : function( s ){ return s; },
 		"currency" : function( n ){ return "<i icon rupee></i>" + Number(n).toFixed(2); },
 		"deleteBtn" : function(){
			delBtn = createElement({"tag" : "button", "class" : "ui circular red delete icon button", "onclick":"delBtnPress(this)"});
			delBtn.append( createElement({"tag": "i", "class":"icon remove"}));
			return delBtn[0];
		},
		"selectBtn" : function(){
			editBtn = createElement({"tag": "button", "class":"ui circular icon select blue button", "onclick":"selectBtnPress(this)"});
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
	},

	"invoices" : {
		"data" : [],
		"selectedIndex" : 0,	
	},

	"products" : {
		"data" : [],
		"selectedIndex" : 0
	},

	"transactions" : {
		"data" : [],
		"selectedIndex" : 0
	},

	"accounts" : {
		"data" : [],
		"selectedIndex" : 0
	},
	"copier" : {
		"data" : [],
		"selectedIndex" : 0
	},
	"templateRows" : {

	}

};

