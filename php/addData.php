<?php 
	define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'] . "/masterApp");

	include_once ROOT_DIR . "/settings/connection.php";
	require_once ROOT_DIR . "/settings/objects.php";

	$objectType = $_GET['t'];

	if( isset($_POST['0']) ) $data = $_POST['0'];
	else $data = $_POST;

	$myObject = new table($con, $objectType);
	$myObject->insertRow($data);
	$lastQuery = $myObject->query;
	$myObject->executeQuery();


	$output = array("lastInsertId" => $myObject->lastInsertId(), 
		"message"=>"Successfully Added Record to $objectType", 
		"lastQuery"=>$lastQuery,
		"post"=>$data);

	echo json_encode($output);
?>	