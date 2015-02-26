<!-- ::START:: customers.php-->
<div class="ui top attached tabular menu">

	<a class="active item"><i class="icon plus"></i>Add New Customer</a>
	<a class="item"><i class="icon edit"></i>View Customer</a>

</div>

<div class="ui bottom attached segment" style="padding:10px 0px 10px 0px">

	<div class="ui basic segment">

		<?php
			$url = "php/addData.php?t=customers";
			$form_id = "addCustomerForm";
			$enable_id_field = false;
		?>

		<?php include 'customerForm.php'; ?>

	</div>

	<div class="ui basic segment">

		<div class="container" id="selectCustomerSegment" data-next="editCustomerSegment" style="margin:0px;">
			<?php include_once 'customerTable.php'; ?>
		</div>

		<div class="container" id="editCustomerSegment" data-prev="selectCustomerSegment">
			<button class="ui fluid back button"><i class="icon arrow up"></i></button>

			<?php
				$url = "php/updateData.php?t=customers";
				$form_id = "editCustomerForm";
				$enable_id_field = true;
			 ?>

			<?php include 'customerForm.php' ?>
		</div>

	</div>

</div>

<!--::END:: customers.php-->
