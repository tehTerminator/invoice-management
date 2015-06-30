<?php 
	define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'] . "/masterApp");

	if( isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == true ){
		echo "";
	} else{
		header("Location: login.php");
		die();
	}
?>