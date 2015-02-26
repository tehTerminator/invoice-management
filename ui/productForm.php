<!--::START:: productForm.php-->
	<form id='<?php echo $form_id; ?>' data-action='<?php echo $url; ?>' class="ui form segment" data-validation="true" data-source="products">

		<?php if($enable_id_field): ?>
			<div class="required field">
				<label for="id">Product Id</label>
				<input type="text" data-required="true" name="id">
			</div>
		<?php endif; ?>

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
<!--::END:: productForm.php-->
