<div class="row">

	<div id="addInvoiceForm" class="ui form segment" data-action="php/addData.php?t=invoices" data-validation='true'>

		<div class="row">
			<div class="ui header">Customer Information</div>
			<div class="ui three fields" data-source="customers">

				<div class="two wide field">
					<label for="customer_id">Customer Id</label>
					<input type="text" name="customer_id" readonly>
				</div>

				<div class="four wide field">
					<label for="customer_name">Customer Name</label>
					<input type="text" name="customer_name" readonly>
				</div>

				<div class="ten wide field">
					<label for="customer_company">Company</label>
					<input type="text" name="customer_company" readonly>
				</div>

			</div>
		</div>

		<div class="ui fluid three fields">
			<div class="field">
				<label for="invoice_date">Invoice Date</label>
				<input type="date" name="invoice_date" data-required="true">
			</div>

			<div class="field">
				<label for="notes">Notes</label>
				<input type="text" id="invoice_note" name="notes" data-required="true">
			</div>

			<div class="field">
				<label for="paid">Paid</label>
				<div class="ui toggle checkbox">
					<input id="paid" type="checkbox" name="paid" value="0">
				</div>
			</div>

		</div>

	</div>

</div>

<div class="row">

	<div id="addTransactionsForm" action="" class="ui form segment">

		<div class="ui five fields">
			<div class="field">
				<label for="Product">Product</label>
				<div class="ui fluid search dropdown" data-source="products">
					<input type="hidden" name="product_id" onchange="updateRow(this)">
					<div class="default text">Product Name</div>
					<div class="menu">
						<!--Items Will Be Added Automatically-->
					</div>
				</div>
			</div>

			<div class="field">
				<label for="rate">Rate</label>
				<input id="product_rate" type="number" readonly>
			</div>

			<div class="field">
				<label for="quantity">Quantity</label>
				<input name="quantity" type="number" onchange="updateAmount(this)">
			</div>

			<div class="field">
				<label for="discount">Discount</label>
				<input name="discount" type="number" onchange="updateAmount(this)">
			</div>

			<div class="field">
				<label for="amount">Amount</label>
				<input name="amount" type="number" readonly>
			</div>

		</div>

	</div><!--Form Segment Ends Here-->

	<button id="addRowBtn" class="ui blue button">Add Data</button>

</div>
