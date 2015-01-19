<!--::START:: addProduct.php-->
	<form data-action="php/addData.php?t=products" class="ui form segment" data-validation="true">

		<div class="two fluid fields">
			<div class="required field">
				<label for="name">Product Name</label>
				<input type="text" data-required="true" name="name">
			</div>

			<div class="field">
				<div class="ui toggle checkbox">
					<input type="checkbox" data-required="true" name="isLimited">
					<label for="isLimited">Limited</label>
				</div>
			</div>
			

		</div>

		<div class="two fluid fields">
			<div class="field">
				<label for="quantity">Available Quantity</label>
				<input type="text" data-required="true" name="quantity">
			</div>
			<div class="required field">
				<label for="rate">Rate</label>
				<div class="ui icon input">
					<input type="text" name="rate">
					<i class="icon rupee"></i>
				</div>
			</div>
		</div>

		<div class="ui field">
			<label for="notes">Notes</label>
			<textarea name="notes"></textarea>
		</div>
		
		<br />
		<br />
		<button class="ui right floated labeled icon blue submit button"><i class="icon save"></i>Submit</button>
	</form>
<!--::END:: addProduct.php-->