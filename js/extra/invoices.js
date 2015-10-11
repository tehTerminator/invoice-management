jQuery("document").ready(function(){
	autoload(['customers', 'products', 'invoices']);
	executeTasks( [fillDropdown] );
	executeTasks( global.tasks );

});

function loadTransactions(){
	global.clearCachedData('transactions');
	load('transactions|invoice_id=' + global['invoices']['selectedIndex']);
	setTimeout(function(){
		jQuery("#transactionsTable").fillTable();
	}, 2000);
}

//Change Rate in Row
function updateRow( element ){
	"use strict";
	var rate = 0;
	try{
		var rate = global['products']['data'][element.value]['rate'];
	} catch(exception){
		rate = 0;
	}
	jQuery("#rate").val( rate );
	updateAmount();
}

//Update Amount in Row;
function updateAmount(){
	"use strict";
	var rate = jQuery("#rate").val(),
		qty = jQuery("#quantity").val(),
		disc = jQuery("#discount").val(),
		amt = Number((rate*qty)*(1-disc/100));

	jQuery("#amount").val( amt );
}


//Bind Events after Some Elements are created
	jQuery("#postInvoiceBtn").on('click', function(){
		
		if( global['transactions']['data'].length == 0 ) return false;

		var header = "Do you want to post Invoice";
		var statement = '<i class="icon warning"></i>Warning, this command will be irreversible and you wont be able to post any more transactions to the invoice. If you still want to add more Transactions please click Cancel, or Proceed by clicking Okay Button'

		feedback(header, statement, function(){
			executeTasks(['jQuery("#addInvoiceForm").form("submit");', postTransactions]);
		});

		return false;
	});

	jQuery("#addRowBtn").on('click', function(){

		if( global['transactions'] === undefined || global['transactions']['hash'] === undefined ){
			global['transactions'] = {
				'hash' : {}
			}
		}

		var product_id = jQuery("#product_id").val(),
			quantity = jQuery("#quantity").val(),
			discount = jQuery("#discount").val();

		var transactions = global['transactions'];

		//If Products are not already available in Transaction then Add Product
		if( transactions['hash'][product_id] !== undefined ){
			transactions['hash'][product_id]["quantity"] = Number(quantity) + Number(transactions['hash'][product_id]["quantity"]);
			transactions['hash'][product_id]["discount"] = Number(discount);
		}
		else{
			//Update Quantity
			transactions['hash'][product_id] = {
				'quantity' : quantity,
				'discount' : discount
			};
		}

		//Recreate the list of Transactions from Hash Map
		transactions.data = [];
		for(var pid in global.transactions.hash){
			global.transactions.data.push({
				"product_id" 	: pid,
				"quantity" 		: transactions['hash'][pid]['quantity'],
				"discount" 		: transactions['hash'][pid]['discount']
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

function removeTransaction(element){
	"use strict";
	element = jQuery(element);
	

	var dataIndex = element.closest("tr").attr("data-index"),
	table = element.closest("table"),
	product_id = global.transactions.data[dataIndex]['product_id'];
	try{
		delete global.transactions['hash'][product_id];
	} catch(e){
		console.log( "Transaction Hash not present" );
	}
	global.transactions['data'].splice(dataIndex, 1);

	element.closest("tr").slideUp('fast').remove();

	table.fillTable();
}

function postTransactions(){

	var invoice_id = global.message.lastInsertId

	//Add Invoice Id to Transactions
	for(var t in global.transactions.data){
		global['transactions']['data'][t]['invoice_id'] = invoice_id;
	}


	jQuery.post("php/addData.php?t=transactions", {0:global.transactions.data}, function(data){
		try{
			global.message = JSON.parse(data)

			window.open("ui/printInvoice.php?i=" + invoice_id);
		}
		catch(e){
			global.message = data;
		}
	});
}


function markPaid( element ){
	var invoiceId = jQuery(element).closest("tr").attr("data-index");
	if( global['invoices']['data'][invoiceId]['paid'] === "1" )
		feedback("Invoice Already Paid", "The Invoice You are trying to Mark Paid is already Paid", function(){
			return false;
		});
	else{
		feedback("Mark Invoice as Paid", "Do You want to Mark this Invoice As Paid.?", function(){
			var note = prompt("Enter Some Payment Details");
			$.ajax({
					url: 'php/updateData.php?t=invoices',
					type: 'post',
					data: {
						'id' : invoiceId,
						'paid' : 1,
						'notes' : note
					},
					success: function (data) {
						jQuery(element).closest("tr").find("td > i.icon.remove").removeClass("remove").addClass("checkmark");
						global['invoices']['data'][invoiceId]['paid'] = 1;
						try{
							global.message = JSON.parse(data);
						} catch(e){
							global.message = data;
						}
					}
				});
		});
	}
}

function markUnpaid( element ){
	var invoiceId = jQuery(element).closest("tr").attr("data-index");
	if( global['invoices']['data'][invoiceId]['paid'] === "1"){
		feedback("Mark Unpaid", "Are you sure you want to mark this Invoice Unpaid? Please Provide the reason", function(){
			var note = prompt("Enter Reason to Mark Unpaid Invoice");
			$.ajax({
					url: 'php/updateData.php?t=invoices',
					type: 'post',
					data: {
						'id' : invoiceId,
						'paid' : 0,
						'notes' : note
					},
					success: function (data) {
						jQuery(element).closest("tr").find("td > i.icon.checkmark").removeClass("checkmark").addClass("remove");
						global['invoices']['data'][invoiceId]['paid'] = 0;
						try{
							global.message = JSON.parse(data);
						} catch(e){
							global.message = data;
						}
					}
				});
		});
	} else{
		feedback("Already Unpaid", "The Invoice that you are trying to mark as unpaid is already mark Unpaid", function(){
			return false;
		});
	}
}

jQuery("#printInvoiceBtn").on('click', function(){
	var invoice_id = jQuery("#invoice_id").val();
	window.open("ui/printInvoice.php?i=" + invoice_id);
});
