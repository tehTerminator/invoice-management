<?php 
	define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'] . "/masterApp");

	include_once ROOT_DIR . "/settings/connection.php";
	require_once ROOT_DIR . "/settings/objects.php";

	$objectType = $_GET['t'];
	$data = $_POST;

	$myObject = new table($con, $objectType);
	$id = $_POST['id'];
	unset($_POST['id']);

	$myObject->updateData($_POST, 'id = ' . $id );
	$lastQuery = $myObject->query;
	$myObject->executeQuery();

	$output = array( "message"=>"Successfully Added Record to $objectType", 
		"lastQuery"=>$lastQuery,
	"post"=>$data);

	echo json_encode($output);