<?php
	define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'] . "/projects/masterApp");
	
	include_once ROOT_DIR . "/settings/connection.php";
	require_once ROOT_DIR . "/settings/objects.php";


	session_start();

	$username = $_POST['username'];
	$password = $_POST['password'];

	$myObject = new table($con, 'dbuser');
	$myObject->getData("username = '$username' AND password = '$password'", "", "", "");

	echo $myObject->query;



	$myObject->executeQuery();

	$result = $myObject->getResult();


	if( count($result) > 0 ){
		$_SESSION['is_logged_in'] = true;
	} else{
		$_SESSION['is_logged_in'] = false;
	}

	if( isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == true ){
		header("Location:index.php");
		die();
	} else{
		header("Location:login.php");
		die();
	}
?>