<?php 
	define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'] . "/masterApp");

	include_once ROOT_DIR . "/settings/connection.php";
	require_once ROOT_DIR . "/settings/objects.php";

	$objectType = $_GET['t'];

	$myObject = new table($con, $objectType);
	$myObject->insertRow($_POST);
	$lastQuery = $myObject->query;
	$myObject->executeQuery();


	$output = array("lastInsertId" => $myObject->lastInsertId(), "message"=>"Successfully Added Record to $objectType", "lastQuery"=>$lastQuery);

	echo json_encode($output);
?>	