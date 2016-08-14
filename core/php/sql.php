<?php
    define('LOCALHOST', 'localhost');
    define('DBNAME', 'invm');
    define('USER', 'root');
    define('PASSWORD', 'Toor*7391');
    
    $connection = null;
    
    $request = json_decode( file_get_contents("php://input") );
    
    try{
        $connection = new PDO('mysql:host=localhost;dbname=' . DBNAME, USER, PASSWORD);
        // $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    } catch( PDOException $ex ){
        die( json_encode(
            array(
                'result'=>false,
                'exception'=>$ex->getMessage()
            )
        ) );
    }

    require_once 'ds.php';
    
    $query_type = $request->queryType;
    $tableName = $request->tableName;
    $params = isset( $request->params ) ? json_decode(json_encode($request->params), true) : null;
    
    $adapter = new DataAdapter($connection, $tableName);
    $adapter->generateQuery($query_type, $params);
    $adapter->execute();
    $adapter->echo_output();   
    
