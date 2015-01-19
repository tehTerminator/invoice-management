<!--::START:: editProductForm.php-->
<div class="container" id="editProductSegment" data-prev="selectProductSegment">
	<button class="ui fluid back button"><i class="icon arrow up"></i></button>

	<form data-action="php/addData.php?t=products" data-source="products" class="ui form segment" data-validation="true">
		
		<div class="required field">
			<label for="id">Product Id</label>
			<input type="text" data-required="true" name="id">
		</div>


		<div class="two fluid fields">
			<div class="required field">
				<label for="name">Product Name</label>
				<input type="text" data-required="true" name="name">
			</div>

			<div class="field">
				<div class="ui toggle checkbox">
					<input type="checkbox" data-required="true" name="isLimited" value="0">
					<label for="isLimited">Limited</label>
				</div>
			</div>
			

		</div>

		<div class="two fluid fields">
			<div class="field">
				<label for="quantity">Available Quantity</label>
				<input type="text" name="quantity" value="0">
			</div>
			<div class="required field">
				<label for="rate">Rate</label>
				<div class="ui icon input">
					<input type="text" name="rate">
					<i class="icon rupee"></i>
				</div>
			</div>
		</div>
		
		<br />
		<br />
		<button class="ui right floated labeled icon blue submit button"><i class="icon save"></i>Submit</button>
	</form>
</div>
<!--::END:: editProductForm.php-->