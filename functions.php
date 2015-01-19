<?php 
	function load($extension){
		$dir = "$extension/";

		$pattern = "$extension/*.{$extension}";

		foreach (glob($pattern) as $filename) {
			# code...
			if( $extension == "js" )
				echo "<script type='text/javascript' src='$filename' async></script>";
			else
				echo "<link rel='stylesheet' type='text/css' href='$filename' />";
		}
	}

	function insertRow($db, $table, $variables, $terminals){
		$query = "INSERT INTO " . $table;
		$query .= "(" . implode(",", $variables) . ")";
		$query .= " VALUES('" . implode("','", $terminals) . "')";

		try {
			$db->exec($query);
		} catch (PDOException $e) {
			die( $e->getMessage() );
		}
	}

	function isMulti($arr){
		foreach($arr as $a){
			if( is_array($a) ) return true;
		}
		return false;
	}


