<!-- ::START:: customers.php-->
<div class="ui top attached tabular menu">

	<a class="active item"><i class="icon plus"></i>Add New Customer</a>
	<a class="item"><i class="icon edit"></i>View Customer</a>

</div>

<div class="ui bottom attached segment" style="padding:10px 0px 10px 0px">
	
	<div class="ui basic segment">
	
		<?php include_once 'addCustomerForm.php'; ?>

	</div>

	<div class="ui basic segment">

		<div class="container" id="selectCustomerSegment" data-next="<?php echo $ctn; ?>" style="margin:0px;">
			<?php include_once 'customerTable.php'; ?>
		</div>

		<div class="container" id="editCustomerSegment" data-prev="selectCustomerSegment">
			<?php include_once 'editCustomerForm.php' ?>
		</div>
		
	</div>

</div>

<!--::END:: customers.php-->