jQuery("document").ready(function(){
	autoload(['customers|0|name.ASC', 'products|0|name.ASC', 'invoices']);
	executeTasks( [fillDropdown, moreEvents] );
	executeTasks( global.tasks );
});

function updateRow( element ){
	"use strict";
	var rate = global['products']['hash'][element.value]['rate'];
	jQuery("#rate").val( rate );
	updateAmount();
}

function updateAmount(){
	"use strict";
	var rate = jQuery("#rate").val(),
		qty = jQuery("#quantity").val(),
		disc = jQuery("#discount").val(),
		amt = Number((rate*qty)*(1-disc/100));

	jQuery("#amount").val( amt );
}

function moreEvents(){

	setTask("More Events")

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
		var product_id = jQuery("#product_id").val(),
			quantity = jQuery("#quantity").val(),
			discount = jQuery("#discount").val();

		//If Products are not already available in Transaction then Add Product
		if( global['transactions']['hash'][product_id] !== undefined ){
			global['transactions']['hash'][product_id]["quantity"] = Number(quantity) + Number(global['transactions']['hash'][product_id]["quantity"]);
			global['transactions']['hash'][product_id]["discount"] = Number(discount);
		}
		else{
			//Update Quantity
			global['transactions']['hash'][product_id] = {
				'quantity' : quantity,
				'discount' : discount
			};
		}

		//Recreate the list of Transactions from Hash Map
		global.transactions.data = [];
		for(var pid in global.transactions.hash){
			global.transactions.data.push({
				"product_id" 	: pid,
				"product_name" 	: global['products']['hash'][pid]['name'],
				"rate" 			: global['products']['hash'][pid]['rate'],
				"quantity" 		: global['transactions']['hash'][pid]['quantity'],
				"discount" 		: global['transactions']['hash'][pid]['discount']
			});
		}

		//Recreate Data in Table
		jQuery("#showInvoiceTable").clearTable();
		jQuery("#showInvoiceTable").fillTable();

		jQuery("#quantity").val(0);
		jQuery("#discount").val(0);
		jQuery("#product_id").closest(".ui.dropdown").dropdown('restore defaults');
		jQuery("[tabindex=0]").focus();
	});
}

function removeTransaction(element){
	"use strict";
	element = jQuery(element);
	

	var dataIndex = element.closest("tr").attr("data-index"),
	table = element.closest("table"),
	product_id = global.transactions.data[dataIndex]['product_id'];
	delete global.transactions['hash'][product_id];
	global.transactions['data'].splice(dataIndex, 1);

	element.closest("tr").slideUp('fast').remove();

	table.clearTable();
	table.fillTable();
}
