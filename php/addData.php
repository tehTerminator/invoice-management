<?php 
	define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'] . "/masterApp");

	include_once ROOT_DIR . "/settings/connection.php";
	require_once ROOT_DIR . "/settings/objects.php";

	$objectType = $_GET['t'];

	$myObject = new table($con, $objectType);

	print_r($_POST);

	$myObject->insertRow($_POST);
	echo $myObject->query;
	$myObject->executeQuery();
	
	echo "Sucessfully Added Data";

?>	