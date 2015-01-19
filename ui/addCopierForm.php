<form id="addCopierForm" class="ui form segment" data-action="php/addData.php?t=copier" data-validation="true">
	
	<h2 class="ui header">Add Photocopier Reading</h2>

	<div class="ui three fields">
		
		<div class="ui field"><label for="copier_reading">Copier Reading</label><input type="text" name="copier_reading" data-required="true"></div>
		<div class="ui field"><label for="total_reading">Total Reading</label><input type="text" name="total_reading" data-required="true"></div>
		<div class="ui field"><label for="notes">Description</label><input type="text" name="notes" data-required="true"></div>

	</div>

	<button class="ui right floated blue submit labeled icon button"><i class="icon save"></i>Submit</button>
		
</form>
