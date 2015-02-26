<?php 
	define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'] . "/masterApp");

	include_once ROOT_DIR . "/settings/connection.php";
	require_once ROOT_DIR . "/settings/objects.php";

	$objectType = $_GET['t'];

	$id = isset($_GET['id']) ? $_GET['id'] : "";
	$limit = isset($_GET['limit']) ? $_GET['limit'] : 0;
	$orderBy = isset($_GET['orderby']) ? $_GET['orderby'] : "";
	$orderType = isset($_GET['ordertype']) ? $_GET['ordertype'] : "";

	if( $id > 0 ) $condition = "id = " . $id;
	else $condition = "";


	$myObject = new table($con, $objectType);

	$myObject->getData($condition, $orderBy, $orderType, $limit);
	$myObject->executeQuery();
	echo $myObject->getJSON();
 ?>