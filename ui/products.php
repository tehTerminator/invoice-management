<!--::START:: products.php-->

<div class="ui top attached tabular menu">

	<a class="active item"><i class="icon plus"></i>Add New Product</a>
	<a class="item"><i class="icon edit"></i>Edit Product</a>

</div>

<div class="ui bottom attached segment" style="padding:10px 0px 10px 0px">
	
	<div class="ui basic segment">
	
		<?php include_once 'addProductForm.php'; ?>

	</div>

	<div class="ui basic segment">
		<?php include_once 'productTable.php' ?>
		<?php include_once 'editProductForm.php' ?>
	</div>

</div>


<!--::END:: products.php-->