<div class="row">

	<form id="<?php echo $form_id; ?>" class="ui form segment">

		<div class="row" data-source="customers">
			<div class="ui header">Customer Information</div>
			<div class="ui three fields">

				<div class="two wide field">
					<label for="customer_id">Customer Id</label>
					<input type="text" name="id" readonly tabindex="-1">
				</div>

				<div class="four wide field">
					<label for="customer_name">Customer Name</label>
					<input type="text" name="name" readonly tabindex="-1">
				</div>

				<div class="ten wide field">
					<label for="customer_company">Company</label>
					<input type="text" name="company" readonly tabindex="-1">
				</div>

			</div>
		</div>

		<div class="ui fluid four fields" data-source="invoices">
			
			<?php if( $enable_id_field ): ?>

			<div class="field">
				<label for="id">Invoice Id</label>
				<input id="invoice_id" type="number" name="id" data-required="true" tabindex="-1">
			</div>

			<?php endif; ?>
				
			<div class="field">
				<label for="invoice_date">Invoice Date</label>
				<input type="date" name="invoice_date" data-required="true" tabindex="-1">
			</div>

			<div class="field">
				<label for="notes">Notes</label>
				<input type="text" id="note" name="notes" data-required="true" tabindex="-1">
			</div>

			<div class="field">
				<label for="paid">Paid</label>
				<div class="ui toggle checkbox">
					<input id="paid" type="checkbox" name="paid" value="0" tabindex="-1">
				</div>
			</div>

		
		</div>

	</form>

</div>