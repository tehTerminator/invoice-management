<!--::START:: editCustomerForm.php-->
<button class="ui fluid back button"><i class="icon arrow up"></i></button>
<form id="editCustomerForm" data-action="php/updateData.php?t=customers" class="ui form segment" data-validation="true" data-source="customers">
	
	<div class="required field">
		<label for="name">Customer ID</label>
		<input type="text" data-required="true" name="id" readonly>
	</div>

	<div class="two fluid fields">

		<div class="required field">
			<label for="name">Customer Name</label>
			<input type="text" data-required="true" name="name">
		</div>

		<div class="fluid field">
			<label for="name">Company</label>
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
	<button class="ui right floated labeled icon blue submit button"><i class="icon save"></i>Submit</button>
</form>
<!--::END:: editCustomerForm.php-->