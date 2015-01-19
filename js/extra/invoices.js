jQuery("document").ready(function(){
	autoload(['customers|0|name.ASC', 'products|0|name.ASC', 'invoices']);
	executeTasks( [fillDropdown, storeRates] );
	executeTasks( global.tasks );
});

function storeRates(){
	"use strict";

	setTask('Storing Product Rates');
	var source = global['products'].data,
	invoices = global['invoices'];
	invoices['product_rates'] = {};
	for(var i=0; i < source.length; i++){
		invoices['product_rates'][ source[i].id ] = source[i].rate;
	}
}

function updateRow( element ){
	var e = jQuery(element),
	rateList = global['invoices']['product_rates'],
	callee = e.attr("name").substr(0, e.attr("name").length-2);
	if( callee == "product_id"  ){
		e.closest("tr").find("[name='rate[]']").val( rateList[ e.val() ] );
		updateAmount( element );
	}
}

function updateAmount( element ){
	e = jQuery(element),
	row = e.closest("tr"),
	quantity = row.find("[name='quantity[]']").val(),
	rate = row.find("[name='rate[]']").val(),
	discount = row.find("[name='discount[]']").val(),
	total = 0;

	row.find("[name='amount[]']").val( (quantity * rate) * (1-discount/100) );

	row.closest("table").find("[name='amount[]'").each(function(){
		total += jQuery(this).val();
	});

	row.closest("table").find(".grandTotal").val(total);
}