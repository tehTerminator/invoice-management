<?php require_once 'header.php'; ?>

<body>
		<div class="ui one column page grid" style="margin-top:5px;">

			<div class="column">

				<div class="ui sticky row">

					<?php require_once 'nav.php'; ?>

				</div>

				<main class="row">

					<div class="ui bottom attached active tab segment" data-tab="dashboard.php"></div>
					<div class="ui bottom attached tab segment" data-tab="customers.php"></div>
					<div class="ui bottom attached tab segment" data-tab="products.php"></div>
					<div class="ui bottom attached tab segment" data-tab="invoices.php"></div>
					<div class="ui bottom attached tab segment" data-tab="reports.php"></div>

				</main>

				<div class="ui small modal" id="smallModal">
					
					<i class="inverted red circular close icon"></i>
					<div class="header" id="modalHeader">Basic Modal For FeedBack</div>
					<div class="content">
						
						<div class="description" id="modalContent">Description</div>

					</div>

					<div class="actions">
						
						<button class="ui negative button" id="modalCancelBtn">Cancel</button>
						<button class="ui positive button" id="modalOkayBtn">Okay</button>

					</div>

				</div>


			</div>


		</div>

</body>
</html>
