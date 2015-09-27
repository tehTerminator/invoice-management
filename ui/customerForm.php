<!--::START:: customerForm.php-->
<form id = '<?php echo $form_id ?>' data-action='<?php echo $url; ?>' class="ui form segment" data-validation="true" data-source="customers">

	<?php if( $enable_id_field ): ?>
		<div class="required field">
			<label for="id">Customer ID</label>
			<input type="number" data-required="true" name="id" readonly>
		</div>

	<?php endif; ?>


	<div class="two fluid fields">

		<div class="required field">
			<label for="name">Customer Name</label>
			<input type="text" data-required="true" name="name">
		</div>

		<div class="fluid field">
			<label for="company">Company</label>
			<input type="text" data-required="true" name="company">
		</div>


	</div>


	<div class="required field">
		<label for="address">Address</label>
		<textarea data-required="true" name="address"></textarea>
	</div>

	<div class="two fluid fields">
		<div class="required field">
			<label for="contact">Contact</label>
			<input type="text" data-required="true" name="contact">
		</div>
		<div class="fluid field">
			<label for="notes">Notes</label>
			<input type="text" name="notes">
		</div>
	</div>

	<br />
	<br />
	<button class="ui labeled icon blue submit button"><i class="icon save"></i>Submit</button>
</form>
<!--::END:: customerForm.php-->
