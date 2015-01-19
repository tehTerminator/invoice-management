<div class="ui top attached tabular menu">

	<a class="active item">Copier Reading</a>
	<a class="item">Cash Ledger</a>
	<a class="item">Cash Details</a>
	<a class="item">Sales</a>
	<a class="item">Others</a>

</div>
<div class="ui bottom attached segment" style="padding:10px 0px 10px 0px">
	
	<div class="ui basic segment">
	
		<?php include_once 'addCopierForm.php'; ?>

		<?php include_once 'recentCopierEntries.php'; ?>

	</div>
	<div class="ui basic hidden segment">
		
		<?php include_once 'addLedgerEntries.php' ?>

	</div>
	<div class="ui basic segment">Tab Index 3 </div>
	<div class="ui basic segment">Tab Index 4 </div>
	<div class="ui basic segment">Tab Index 5 </div>

</div>