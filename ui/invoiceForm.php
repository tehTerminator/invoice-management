<form data-action="php/addData?t=invoices&amp;r=transactions" class="ui form segment">

	<div class="ui segment">
		<div class="ui header">Customer Information</div>
		<div class="ui three fields" data-source="customers" data-type="autofill">
			<div class="two wide field"><label for="id">Customer Id</label><input type="text" name="id" readonly></div>
			<div class="four wide field"><label for="name">Customer Name</label><input type="text" name="name" readonly></div>
			<div class="ten wide field"><label for="company">Company</label><input type="text" name="company" readonly></div>
		</div>
	</div>
	
	<table class="ui center aligned celled table segment" data-type="dynamic" data-source="templateRows">
		<thead>
			<tr>
				<th>Product</th>
				<th>Quantity</th>
				<th>Rate</th>
				<th>Disc.</th>
				<th>Amount</th>
			</tr>
		</thead>
		<tbody>
			<tr class="templateRow">
				<td>	
					<div class="ui fluid search dropdown" data-source="products">
						<input type="hidden" name="product_id[]" onchange="updateRow(this)">
						<div class="default text">Transfer From Account</div>
						<div class="menu">
							
						</div>
					</div>
				</td>
				<td>
					<div class="input"><input type="number" min="0" step="1" value="0" name="quantity[]" onchange="updateAmount(this)"></div>
				</td>
				<td>
					<div class="input"><input type="number" min="0" step="1" name="rate[]" value="0" readonly></div>
				</td>
				<td>
					<div class="input"><input type="number" min="0" max="99" step="0.5" value="0" name="discount[]" onchange="updateAmount(this)"></div>
				</td>
				<td>
					<div class="input"><input type="number" min="0" step="1" value="0" name="amount[]" readonly></div>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<td colspan="1">
				<div class="ui two buttons">
					<button class="ui red icon button"><i class="icon remove"></i></button>
					<button class="ui green icon button"><i class="icon add"></i></button>
				</div>
			</td>

			<td colspan="2">
				<button class="ui right fluid floated blue submit labeled icon button"><i class="icon save"></i>Submit</button>
			</td>

			<td style="text-align:center;"><strong>Total Amount</strong></td>
			<td><div class="ui icon input"><input type="text" readonly><i class="icon rupee"></i></div></td>
		</tfoot>

	</table>


</form>