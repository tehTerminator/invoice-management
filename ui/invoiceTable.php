<!--::START:: invoiceTable.php-->

<table class="ui celled compact stiped table" data-type="autoFill" id="<?php echo $table_id; ?>" data-source="invoices" data-sortable="true">

	<thead>
		<tr>
			<th data-model="id">Invoice Id</th>
			<th data-model="customer_name|query">Customer Name</th>
			<th data-model="invoice_date">Posted On</th>
			<th data-model="paid|checkmark">Invoice Paid</th>
			<th data-model="<?php echo $button_1_data; ?>"><?php echo $button_1_text; ?></th>
			<th data-model="<?php echo $button_2_data ?>"><?php echo $button_2_text; ?></th>
		</tr>
	</thead>

	<tbody></tbody>

</table>

<!--::END:: invoiceTable.php-->