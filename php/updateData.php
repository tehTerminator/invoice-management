<?php 
	define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'] . "/masterApp");

	include_once ROOT_DIR . "/settings/connection.php";
	require_once ROOT_DIR . "/settings/objects.php";

	$objectType = $_GET['t'];

	$myObject = new table($con, $objectType);
	$id = $_POST['id'];
	unset($_POST['id']);

	$myObject->updateData($_POST, 'id = ' . $id );
	$myObject->executeQuery();

	echo "Successfully Updated Data";