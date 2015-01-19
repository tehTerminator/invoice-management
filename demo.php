<?php

include 'settings/connection.php';


$stmt = $con->prepare("INSERT INTO dbuser(username, password) VALUES(?, ?)");
$stmt->execute( array("demo", "demo") ); 

$output = $stmt->fetch();

var_dump($output);

 ?>