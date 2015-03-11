<!--Once the Data is udpated The Results Will Be Shown in this Table-->
<div class="ui segment">

	<table id="<?php echo $id; ?>"class="ui celled striped very compact table" data-type="autoFill" data-source="transactions">
		<thead>
			<tr>
				<th data-model="product_name|query">Product Name</th>
				<th data-model="product_rate|query|currency">Rate</th>
				<th data-model="quantity">Quantity</th>
				<th data-model="discount|decimal">Discount</th>
				<th data-model="amount=(quantity * rate)*(1-discount/100)|eval|currency">Amount</th>
				<th data-model="removeTransaction|deleteBtn">Del</th>
			</tr>
		</thead>

		<tbody></tbody>

		<tfoot>
			<tr>
				<th colspan="4">Grand Total</th>
				<th data-model="amount|sum|currency"></th>
				<th></th>
			</tr>
		</tfoot>
	</table>

</div>
