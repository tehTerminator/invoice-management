<!--Once the Data is udpated The Results Will Be Shown in this Table-->
<div class="ui segment">

	<table id="<?php echo $id; ?>"class="ui celled table segment" data-type="autoFill" data-source="transactions">
		<thead>
			<tr>
				<td data-model="product_name">Product Name</td>
				<td data-model="rate|currency">Rate</td>
				<td data-model="quantity">Quantity</td>
				<td data-model="discount|decimal">Discount</td>
				<td data-model="(quantity * rate)*(1-discount/100)|eval">Amount</td>
				<td data-model="removeTransaction|deleteBtn">Del</td>
			</tr>
		</thead>

		<tbody></tbody>

		<tfoot>
			<tr>
				<td colspan="4">Grand Total</td>
				<td data-model="col5|sum"></td>
			</tr>
		</tfoot>
	</table>

</div>
