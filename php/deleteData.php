<?php 
	define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'] . "/masterApp");

	include_once ROOT_DIR . "/settings/connection.php";
	require_once ROOT_DIR . "/settings/objects.php";

	$objectType = $_GET['t'];

	$myObject = new table($con, $objectType);

	$myObject->deleteRow("id", "=", $_POST['id'] );
	$myObject->execute();
	
	echo "Sucessfully Deleted Data";