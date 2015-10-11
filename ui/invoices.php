<!-- ::START:: invoices.php-->
<div class="ui top attached tabular menu">

	<a class="active item" data-tab="i1">
		<i class="icon plus"></i>
		New Invoice
	</a>

	<a class="item" data-tab="i2">
		<i class="icon edit"></i>
		View / Delete Invoice
	</a>

	<a class="item" data-tab="i3">
		<i class="icon money"></i>
		Mark Paid/Unpaid
	</a>

</div>

<div class="ui bottom attached active tab segment" data-tab="i1">

	<div class="ui basic segment" id="customers" data-next="invoices">

		<?php include 'customerTable.php'; ?>

	</div>


	<div class="ui basic segment" id="invoices" data-prev="customers">

		<div class="ui fluid back button"><i class="icon up arrow"></i></div>

		<?php 
			$enable_id_field 	= false;
			$form_id 			= "addInvoiceForm";
			$url 				= "php/addData.php?t=invoices";
			include 'invoiceForm.php'; 
		?>

		<?php include 'addTransactionForm.php' ?>

		<?php 
			$table_id = "showInvoiceTable"; 
			include 'transactionTable.php';
		?>

		<button id="postInvoiceBtn" class="ui labeled icon button"><i class="icon save"></i>Save Invoice</button>
		
	</div>

</div>

<div class="ui bottom attached tab segment" data-tab="i2">

	<div class="container" id="selectInvoice" data-next="viewInvoice">
		<?php 
			$table_id="invoiceTable";
			$button_1_text = "Sel";
			$button_1_data = "selectBtnPress(this);loadTransactions(this)|selectBtn";
			$button_2_text = "Del";
			$button_2_data = "deleteInvoice|deleteBtn"
		 ?>
		<?php include 'invoiceTable.php' ?>
	</div>

	<div class="container" id="viewInvoice" data-prev="selectInvoice">
		<button class="ui fluid icon back button"><i class="up arrow icon"></i></button>
		<?php 
			$form_id = "showInvoiceForm"; 
			$enable_id_field = true;
			include 'invoiceForm.php';
		?>

		<?php 
			$table_id = "transactionsTable"; 
			include 'transactionTable.php';
		?>

		<button id="printInvoiceBtn" class="ui right floated labeled icon blue button"><i class="icon print"></i>Print</button>
	</div>

	
</div>

<div class="ui bottom attached tab segment" data-tab="i3">
	<?php 
		$form_id = "markInvoiceTable";
		$button_1_text = "Paid";
		$button_1_data = "markPaid(this)|selectBtn";
		$button_2_text = "Unpaid";
		$button_2_data = "markUnpaid(this)|deleteBtn";
		include 'invoiceTable.php';
	 ?>
</div>



<!--::END:: invoices.php-->
