<!-- ::START:: invoices.php-->
<div class="ui top attached tabular menu">

	<a class="active item">
		<i class="icon plus"></i>
		New Invoice
	</a>

	<a class="item">
		<i class="icon edit"></i>
		View / Delete Invoice
	</a>

</div>

<div class="ui bottom attached segment" style="padding:10px 0px 10px 0px">

	<div class="ui basic segment">

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

			<?php 
				$table_id = "showInvoiceTable"; 
				include 'transactionTable.php';
			?>

			<button id="postInvoiceBtn" class="ui labeled icon button"><i class="icon save"></i>Save Invoice</button>
			
		</div>

	</div>

	<div class="ui basic segment">

		<div class="container" id="selectInvoice" data-next="viewInvoice">
			<?php $table_id="invoiceTable"; ?>
			<?php include 'invoiceTable.php' ?>
		</div>

		<div class="container" id="viewInvoice" data-prev="selectInvoice">
			<button class="ui fluid icon back button"><i class="up arrow icon"></i></button>
			<?php 
				$form_id = "showInvoiceForm"; 
				$enable_id_field = true;
				include 'invoiceForm.php';
			?>
		</div>
		
	</div>

</div>

<!--::END:: invoices.php-->
