jQuery("document").ready(function(){
	autoload(['customers|0|name.ASC', 'products|0|name.ASC', 'invoices']);
	executeTasks( [fillDropdown] );
	executeTasks( global.tasks );
});

function updateRow( element ){
	"use strict";
	var e = jQuery(element),
	rate = products['hash'][e.val()][rate];

	jQuery("#product_rate").val( rate );
	updateAmount();
}

function updateAmount(){
	"use strict";
	var rate = jQuery("#product_rate").val(),
		qty = jQuery("#quantity").val(),
		disc = jQuery("#discount").val(),
		amt = Number( (rate * quantity)*(1 - disc / 100 ) );

	jQuery("#amount").val( amt );
}

function moreEvents(){

	jQuery("#postInvoiceBtn").on('click', function(){
		//Add Data and Change Frame
		jQuery("#invoiceStep").find(".step").eq(1).removeClass("active").addClass("completed");
		jQuery("#invoiceStep").find(".step").eq(2).addClass("active");
		jQuery("#invoices").hide();
		jQuery("#transactions").slideDown();
		setTimeout(function(){
			//Wait till Data is updated and then retrieve Data

		}, 1000);
	});

	jQuery("#addRowBtn").on('click', function(){
		//Add Data
		var product_id = jQuery("#product_id").val(),
			quantity = jQuery("#quantity").val(),
			discount = jQuery("#discount").val();

		if( global['transactions']['hash'][product_id] !== undefined ){
			global['transactions']['hash'][product_id]["quantity"] += quantity;
			global['transactions']['hash'][product_id]["discount"] = discount;
		}
		else{
			global['transaction']['hash'][product_id] = {
				'quantity' : quantity,
				'discount' : discount
			};
		}
	}, function(){
		global.transactions.data = [];
		for(var pid in global.transactions.hash){
			global.transactions.data.push({
				"product_id" : pid,
				"product_name" : global['products']['hash'][pid]['name'],
				"rate" : global['products']['hash'][pid]['rate'],
				"quantity" : global['transactions']['hash'][pid]['quantity'],
				"discount" : global['transactions']['hash'][pid]['discount']
			});
		}
	});
}
