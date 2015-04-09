<?php 
	function load($extension){
		$dir = "$extension/";

		$pattern = "$extension/*.{$extension}";

		foreach (glob($pattern) as $filename) {
			# code...
			if( $extension == "js" )
				echo "<script type='text/javascript' src='$filename'></script>\n";
			else
				echo "<link rel='stylesheet' type='text/css' href='$filename' />\n";
		}
	}


	function isMulti($arr){
		if( is_array($arr) ){
			foreach($arr as $a){
				if( is_array($a) ) return true;
			}
		}
		return false;
	}

	$numbers = array("zero", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten", "eleven", "twelve", "thirteen", "fourteen", "fifteen", "sixteen");


