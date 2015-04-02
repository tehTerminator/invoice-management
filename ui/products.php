<!--::START:: products.php-->

<div class="ui top attached tabular menu">

	<a class="active item" data-tab="1">
		<i class="icon plus"></i>
		Add New Product
	</a>
	<a class="item" data-tab="2">
		<i class="icon edit"></i>
		Edit Product
	</a>

</div>

<div class="ui bottom attached active tab segment" data-tab="1">

	<?php
		$form_id = "addProductForm";
		$enable_id_field = false;
		$url = "php/addData.php?t=products"
	 ?>

	<?php include 'productForm.php'; ?>

</div>

<div class="ui bottom attached tab segment" data-tab="2">
	<div class="container" id="selectProductSegment" data-next="editProductSegment" style="margin:0px;">
		<?php include_once 'productTable.php' ?>
	</div>

	<div class="container" id="editProductSegment" data-prev="selectProductSegment">
		<button class="ui fluid back button"><i class="icon arrow up"></i></button>

		<?php
			$form_id = "editProductForm";
			$enable_id_field = true;
			$url = "php/updateData.php?t=products"
		 ?>

		<?php include 'productForm.php' ?>
	</div>
</div>




<!--::END:: products.php-->
