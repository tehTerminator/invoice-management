<?php 
	define('LOCALHOST', "localhost");
	define('USERNAME', 'root');
	define('PASSWORD', '');
	define('DATABASE', 'inv');

	$connectionString = sprintf("mysql:host=%s;dbname=%s", LOCALHOST, DATABASE);

	try{
		$con = new PDO($connectionString, USERNAME, PASSWORD);
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}

?>


