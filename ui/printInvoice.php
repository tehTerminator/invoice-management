<?php 
	define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'] . "/masterApp");

	include_once ROOT_DIR . "/settings/connection.php";
	require_once ROOT_DIR . "/settings/objects.php";

	$invoice_id = $_REQUEST['i'];
	
	$invoices = new table($con, 'invoices');
	$invoices->getData("id = " . $invoice_id, "", "", "");
	$invoices->executeQuery();
	$invoice = $invoices->getResult()[0];
	
	$customers = new table($con, "customers");
	$customers->getData("id = " . $invoice['customer_id'], "", "", "");
	$customers->executeQuery();
	$customer = $customers->getResult()[0];

	$transactions = new table($con, 'transactions');

	$query = "SELECT products.name AS product_name, products.notes as product_notes, quantity, products.rate AS rate, discount FROM transactions JOIN products ON products.id = transactions.product_id AND transactions.invoice_id = $invoice_id";

	$transactions->setQuery($query);
	$transactions->executeQuery();

	$transaction = $transactions->getResult();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Invoice Number : <?=$invoice_id?></title>
		<style>
			*{
				font-family:Courier New;
			}
			.bills{
				width:49%;
				height:100%;
				border:5px SOLID;
				margin-left:auto;
				margin-right:auto;
				border:1px SOLID BLACK
			}
			.bills h2 {
				font-family: Trebuchet MS, Arial, Helvetica, sans-serif;
				margin:0px;
				padding:0px;
				display:block;
			}
			
			.bills p{
				margin:0px;
				display:block;
				font-size:0.9em;
			}
			#logo{
				float:left;
				margin:2px 15px 2px 3px;
			}
			
			.invoice{
				border-collapse:collapse;
				border:1px SOLID BLACK;
			}
			
			.invoice td{
				height:20px;
				min-height:20px;
			}
			
			.invoice tfoot{
				text-align:right;
			}
			
			.invoice tbody tr td:not(:first-child){
				font-family: Courier New;
				font-size: 14px;
				text-align:right;
			}
			
			.invoice tbody tr td:first-child{
				font-family: Courier New;
				font-size: 12px;
				text-align:left;
			}
			
			#stamp{
				position:fixed;
				margin-left:100px;
				margin-top:150px;
				display:block;
				z-index:1000;
				float:left;
				width:200px;
				height:200px;
			}
			
		</style>
		<script type="text/javascript">
			function createDuplicate(){
				var div1 = document.getElementById("001");
				var div2 = document.getElementById("002");
				div2.innerHTML = div1.innerHTML;
			}
		</script>
	</head>
	
	<body onload="createDuplicate()">

		<div id="001" class="bills" style="float:left;">
			<img id="logo" src="http://maharajac.in/images/Logo.JPG" width="100" height="100" alt="Logo" />
			<p><strong>Maharaja Computers</strong></p>
			<p>Kher Complex, Opp Civil Hospital<br />Ashoknagar (M.P.) PIN 473331<br />
            Ph. 075-432-2007; FAX 075-432-20832<br />
			Email : email@maharajac.in<br />
			Website : www.maharajac.in</p>
			<hr />
            <?php 
				echo("<p align='right' style='margin-right:20px;'>Invoice No. : " . $invoice['id'] . "<br />
				Date : " . $invoice['invoice_date'] . "</p>");
			?>
			
			<table width="99%" style="margin-left:auto;margin-right:auto;font-size:12px;">
				<tr>
					<td width="20%" valign="top"><strong>Bill To:</strong></td>
					<td>
					
						<?php
							echo($customer['name'] . "<br />" . $customer['address'] . "<br />Ph." . $customer['contact']);
						?>
					</td>
				</tr>
			</table>
			
			<table class="invoice" width="99%" style="margin-left:auto;margin-right:auto;" border="1">
				<thead>
					<tr>
						<th width="60%">Description</th>
						<th width="10%">Qty</th>
						<th width="10%">Rate</th>
						<th width="10%">Discount</th>
						<th width="10%">Amount</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$printedRows = 0;
						$sum = 0;

						foreach ($transaction as $key => $value) {
							# code...

					?>	<tr>
						<td>
							<?php echo $value['product_name'] . " " . $value['product_notes'] ?>
						</td>
						<td>
							<?php echo $value['quantity']; ?>
						</td>
						<td>
							<?php echo $value['rate']; ?>
						</td>
						<td>
							<?php echo $value['discount']; ?>
						</td>
						<td>
							<?php $sum +=  ($value['quantity'] * $value['rate']) * (1 - $value['discount'] / 100);
							echo ($value['quantity'] * $value['rate']) * (1 - $value['discount'] / 100); ?>
						</td>
						</tr>
					<?php
						$printedRows++; 
						$numOfRows = 0;
						}	

						switch ($printedRows) {
							case $printedRows > 5 && $printedRows < 7:
								# code...
								$numOfRows = 8;
								break;
							case $printedRows > 7:
								# code...
								$numOfRows = 0;
								break;
							
							default:
								# code...
								$numOfRows = 12;
								break;
						}

						if(count($transaction) < $numOfRows ){
							$extra = $numOfRows - count($transaction);
							for($i = 0; $i < $extra; $i++){
								echo("<tr>
								<td></td> <td></td> <td></td> <td></td> <td></td>
								</tr>");
							}
						}
					?>
					<?php
						if($invoice['paid'] == 1 ) echo("<img src='bg_images/paid_stamp.png' alt='paid' id='stamp' />");
					?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="4" style="margin-right:20px;">
							TOTAL
						</td>
						<td>
							<?php
								echo($sum);
							?>
						</td>
					</tr>
				</tfoot>
			</table>
			<br />
			<br />
			<p align="right"> For Maharaja Computers </p>
			<br />
			<p align="center">Thankyou</p>
		</div>
		
		<!--Copy of Bill Content is copied automatically-->
		<div id="002" class="bills" style="float:right;">
			
		</div>
	</body>
</html>