<!--::START:: addInvoice.php -->

<div id="invoiceSteps" class="ui four fluid ordered steps">
	
	<div class="ui active step">
		<div class="content">
			<div class="title">Customer</div>
			<div class="description">Select a Customer</div>
		</div>
	</div>
	<div class="ui disabled step">
		<div class="content">
			<div class="title">Create</div>
			<div class="description">Enter Details of Invoice</div>
		</div>
	</div>
	<div class="ui disabled step">
		<div class="content">
			<div class="title">Review</div>
			<div class="description">Check Invoice Details</div>
		</div>
	</div>
	<div class="ui disabled step">
		<div class="content">
			<div class="title">Print</div>
			<div class="description">Print Posted Invoice</div>
		</div>
	</div>

</div>

<div class="ui basic segment" id="selectCustomerTable" data-next="createInvoiceForm" data-step="invoiceSteps0">
	<?php include_once 'customerTable.php'; ?>
</div>
<div class="ui basic segment" id="createInvoiceForm" data-next="reviewInvoicePage" data-prev="selectCustomerTable" data-step="invoiceSteps1">
	<button class="ui fluid back button"><i class="icon up arrow"></i></button>
	<?php include_once 'invoiceForm.php' ?>
</div>
<div class="ui basic segment" id="reviewInvoicePage" data-next="printInvoicePage" data-prev="createInvoiceForm" data-step="invoiceSteps2"></div>
<div class="ui basic segment" id="printInvoicePage" data-prev="reviewInvoicePage" data-step="invoiceSteps3"></div>

<!--::END:: addInvoiceForm.php -->