<!-- ::START:: customers.php-->
<div class="ui top attached tabular menu">

	<a class="active item" data-tab="1">
		<i class="icon plus"></i>
		Add New Customer
	</a>

	<a class="item" data-tab="2"> 
		<i class="icon edit"></i>
		View / Delete Customer
	</a>

</div>

<div class="ui bottom attached active tab segment" data-tab="1">

	<?php
		$url 				= "php/addData.php?t=customers";
		$form_id 			= "addCustomerForm";
		$enable_id_field 	= false;

		include 'customerForm.php';
	?>

</div>

<div class="ui bottom attached tab segment" data-tab="2">

	<div class="container" id="selectCustomerSegment" data-next="editCustomerSegment" style="margin:0px;">

		<?php include_once 'customerTable.php'; ?>

	</div>

	<div class="container" id="editCustomerSegment" data-prev="selectCustomerSegment">
		<button class="ui fluid back button"><i class="icon arrow up"></i></button>

		<?php
			$url 				= "php/updateData.php?t=customers";
			$form_id 			= "editCustomerForm";
			$enable_id_field 	= true;

			include 'customerForm.php';
		 ?>

	</div>

</div>


<!--::END:: customers.php-->
