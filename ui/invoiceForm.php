<div class="row">

	<div id="addInvoiceForm" class="ui form segment" data-action="php/addData.php?t=invoices" data-validation='true'>

		<div class="row">
			<div class="ui header">Customer Information</div>
			<div class="ui three fields" data-source="customers">

				<div class="two wide field">
					<label for="customer_id">Customer Id</label>
					<input type="text" name="customer_id" readonly tabindex="-1">
				</div>

				<div class="four wide field">
					<label for="customer_name">Customer Name</label>
					<input type="text" name="customer_name" readonly tabindex="-1">
				</div>

				<div class="ten wide field">
					<label for="customer_company">Company</label>
					<input type="text" name="customer_company" readonly tabindex="-1">
				</div>

			</div>
		</div>

		<div class="ui fluid four fields">
			<div class="field">
				<label for="invoice_date">Invoice Date</label>
				<input type="date" name="invoice_date" data-required="true" tabindex="-1">
			</div>

			<div class="field">
				<label for="notes">Notes</label>
				<input type="text" id="invoice_note" name="notes" data-required="true" tabindex="-1">
			</div>

			<div class="field">
				<label for="paid">Paid</label>
				<div class="ui toggle checkbox">
					<input id="paid" type="checkbox" name="paid" value="0" tabindex="-1">
				</div>
			</div>

			<div class="field">
				<button id="addRowBtn" class="ui blue button" tabindex="3">Add Data</button>
			</div>

		</div>

	</div>

</div>

<div class="row">

	<div id="addTransactionsForm" action="" class="ui form segment" data-validation="true">

		<div class="ui five fields">
			<div class="field">
				<label for="Product">Product</label>
				<div class="ui fluid upward selection search dropdown" data-source="products">
					<input id="product_id" type="hidden" name="product_id" onchange="updateRow(this)">
					<i class="dropdown icon"></i>
					<div class="default text">Product Name</div>
					<div class="menu">
						<!--Items Will Be Added Automatically-->
					</div>
				</div>
			</div>

			<div class="field">
				<label for="rate">Rate</label>
				<input id="rate" value="0" type="number" readonly tabindex="-1">
			</div>

			<div class="field">
				<label for="quantity">Quantity</label>
				<input id="quantity" name="quantity" type="number" value="0" min="0" onchange="updateAmount()" tabindex="1">
			</div>

			<div class="field">
				<label for="discount">Discount</label>
				<input id="discount" name="discount" value="0" min="0" max="99" type="number" onchange="updateAmount()" tabindex="2">
			</div>

			<div class="field">
				<label for="amount">Amount</label>
				<input id="amount" name="amount" min="0" type="number" readonly tabindex="-1">
			</div>

		</div>

	</div>
</div>
