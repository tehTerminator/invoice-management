<!-- ::START:: invoices.php-->
<div class="ui top attached tabular menu">

	<a class="active item"><i class="icon plus"></i>New Invoice</a>
	<a class="item"><i class="icon edit"></i>View / Delete Invoice</a>

</div>

<div class="ui bottom attached segment" style="padding:10px 0px 10px 0px">
	
	<div class="ui basic segment">
	
		<?php include 'addInvoice.php'; ?>

	</div>

	<div class="ui basic segment">
		<?php include_once 'invoiceTable.php' ?>
		<?php include 'invoiceForm.php?url="php/editData.php"&url_param=invoices"' ?>
	</div>

</div>

<!--::END:: invoices.php-->