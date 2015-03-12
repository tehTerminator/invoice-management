<!--::START:: addInvoice.php -->
<div class="ui basic segment" id="customers" data-next="invoices">

	<?php include 'customerTable.php'; ?>

</div>


<div class="ui basic segment" id="invoices" data-prev="customers">

	<div class="ui fluid back button"><i class="icon up arrow"></i></div>

	<?php 
		$enable_id_field 	= false;
		$form_id 			= "addInvoiceForm"; 
		include 'invoiceForm.php'; 
	?>
	<?php include 'addTransactionForm.php' ?>

	<?php $id="showInvoiceTable"; 
		include 'transactionTable.php'
	?>

	<button id="postInvoiceBtn" class="ui labeled icon button"><i class="icon save"></i>Save Invoice</button>
	
</div>
<!--::END:: addInvoice.php -->
