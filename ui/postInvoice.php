<!--::START:: postInvoice.php-->
<form class="ui form segment" data-action="#" data-validation="true" data-success="setReadOnly">
	
	<h2 class="ui block header">Enter Invoice Data</h2>

	<div class="row" data-source="message">
		
		<div class="ui fluid three fields">
			
			<div class="field"><label for="lastInsertId">Invoice Id</label><input type="text" name="lastInsertId" data-required="false"></div>
			<div class="field"><label for="invoice_date">Invoice Date</label><input type="date" name="invoice_date" data-required="true"></div>
			<div class="field"><label for="notes">Notes</label><input type="text" name="notes" data-required="true"></div> `

		</div>

	</div>

	<div class="row" data-source="customers" data-fields="readonly">
		
		<?php include_once 'editCustomerForm.php' ?>

	</div>

	<div class="row">
	
		<div class="ui toggle checkbox">
			<label for="paid">Paid</label>
			<input type="checkbox" name="paid">
		</div>

		<button id="postInvoiceBtn" class="ui right floated blue button">Post Invoice</button>

	</div>
			
</form>
<!--::END:: postInvoice.php-->