<!--::START:: addInvoice.php -->
<div id="invoiceStep" class="ui ordered four steps">

	<div class="step">
		<div class="content">
			<div class="title">Customer</div>
			<div class="description">Select Customer</div>
		</div>
	</div>
	<div class="step">
		<div class="content">
			<div class="title">Invoice</div>
			<div class="description">Post Invoice</div>
		</div>
	</div>

	<div class="step">
		<div class="content">
			<div class="title">Print</div>
			<div class="description">Print Posted Invoice</div>
		</div>
	</div>

</div>

<div class="ui basic segment" id="customers" data-next="invoices" data-step="invoiceSteps0">
	<?php include 'customerTable.php'; ?>
</div>
<div class="ui basic segment" id="invoices" data-next="transactions" data-prev="customers" data-step="invoiceSteps1">
	<div class="ui fluid back button"><i class="icon up arrow"></i></div>
	<?php include 'invoiceForm.php'; ?>
</div>
<!--::END:: addInvoice.php -->
