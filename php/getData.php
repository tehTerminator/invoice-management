<?php 
	define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'] . "/masterApp");

	include_once ROOT_DIR . "/settings/connection.php";
	require_once ROOT_DIR . "/settings/objects.php";

	$objectType = $_GET['t'];

	$limit = isset($_GET['limit']) ? $_GET['limit'] : 0;
	$orderBy = isset($_GET['orderby']) ? $_GET['orderby'] : "";
	$orderType = isset($_GET['ordertype']) ? $_GET['ordertype'] : "";
	$condition = "";

	$myObject = new table($con, $objectType);

	foreach ($myObject->getResult() as $key => $value) {
		# code...
		$columnName = $value['column_name'];

		if( isset($_GET[$columnName]) ){
			$condition .= "$columnName = '$_GET[$columnName]' AND ";
		}
	}

	if( strlen($condition) > 0 ){
		$length = strlen($condition);
		$condition = substr($condition, 0, $length - 5 );
	}

	$myObject->getData($condition, $orderBy, $orderType, $limit);

	$myObject->executeQuery();
	echo $myObject->getJSON();