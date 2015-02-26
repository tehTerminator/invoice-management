<?php 
	define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'] . "/masterApp");

	include_once ROOT_DIR . "/settings/connection.php";
	require_once ROOT_DIR . "/settings/objects.php";

	$invoice = new table($con, "invoices");
	$data = $_POST;

	$invoice->insertRow($_POST);
	echo $invoice->query;
	$invoice->executeQuery();

	$lastId = $invoice->lastInsertId();

	$data['invoice_id'] = array_fill(0, count($data['product_id']), $lastId);
	$transactions = new table($con, "transactions");
	$transactions->insertRow($data);
	$transactions
	$transactions->executeQuery();

	$output = array("lastInsertId"=>$lastId, "message"=>"Sucessfully Inserted Data");
	echo json_encode($output);
?>