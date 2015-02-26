<!--::START:: products.php-->

<div class="ui top attached tabular menu">

	<a class="active item"><i class="icon plus"></i>Add New Product</a>
	<a class="item"><i class="icon edit"></i>Edit Product</a>

</div>

<div class="ui bottom attached segment" style="padding:10px 0px 10px 0px">

	<div class="ui basic segment">

		<?php
			$form_id = "addProductForm";
			$enable_id_field = false;
			$url = "php/addData.php?t=products"
		 ?>

		<?php include 'productForm.php'; ?>

	</div>

	<div class="ui basic segment">
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

</div>


<!--::END:: products.php-->
