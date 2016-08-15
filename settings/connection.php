<?php 
	define('LOCALHOST', "localhost");
	define('USERNAME', 'root');
	define('PASSWORD', 'Toor*7391');
	define('DATABASE', 'billings');

	$connectionString = sprintf("mysql:host=%s;dbname=%s", LOCALHOST, DATABASE);

	try{
		$con = new PDO($connectionString, USERNAME, PASSWORD);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}

?>


