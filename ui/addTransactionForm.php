<!--::START:: Add Transaction Form-->
<div class="row">

	<div id="addTransactionsForm" action="" class="ui form segment" data-validation="true">

		<div class="ui six wide fields">
			<div class="six wide required field">
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

			<div class="two wide required field">
				<label for="rate">Rate</label>
				<input id="rate" value="0" type="number" readonly tabindex="-1">
			</div>

			<div class="two wide required field">
				<label for="quantity">Quantity</label>
				<input id="quantity" name="quantity" type="number" value="0" min="0" onchange="updateAmount()" tabindex="1" data-required="true">
			</div>

			<div class="two wide field">
				<label for="discount">Discount</label>
				<input id="discount" name="discount" value="0" min="0" max="99" type="number" onchange="updateAmount()" tabindex="2">
			</div>

			<div class="two wide field">
				<label for="amount">Amount</label>
				<input id="amount" name="amount" min="0" type="number" readonly tabindex="-1">
			</div>

			<div class="two wide field">
				<label for="addRowBtn">Add Row</label>
				<button id="addRowBtn" class="ui fluid icon blue button" tabindex="3"><i class="plus icon"></i></button>

			</div>

		</div>

	</div>
</div>

<!--::END:: Add Transaction Form-->
