<!--::START:: invoiceTable.php-->

<table class="ui celled compact stiped table" data-type="autoFill" id="<?php echo $table_id; ?>" data-source="invoices" data-sortable="true">

	<thead>
		<tr>
			<th data-model="id">Invoice Id</th>
			<th data-model="customer_name|query">Customer Name</th>
			<th data-model="invoice_date">Posted On</th>
			<th data-model="paid|checkmark">Invoice Paid</th>
			<th data-model="selectBtnPress(this);loadTransactions(this)|selectBtn">Sel</th>
			<th data-model="deleteInvoice|deleteBtn">Del</th>
		</tr>
	</thead>

	<tbody></tbody>

</table>

<!--::END:: invoiceTable.php-->