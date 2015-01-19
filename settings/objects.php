<?php
	include_once ROOT_DIR . "/functions.php";

	class table{

		private $name;
		private $dataRow;
		private $db;
		public $query;
		private $stmt;
		private $output;


		function __construct($db, $tableName){
			$this->db = $db;
			$this->name = $tableName;
		}

		function insertRow($data){
			$values = array();
			$this->query = "INSERT INTO $this->name(". implode(",", array_keys($data))  . ") VALUES";

			if( isMulti($data) ){
				$arr = array_fill(0, count($data[0], "?") );
				$placeHolder = "(" . implode(", ", $arr ) . ")";
				$combinedArray = array();
				foreach( $data as $arr ){
					$placeHolderArray[] = $placeHolder;
					$combinedArray[] = array_values($arr);
				}
				$this->query .= implode(", ", $placeHolderArray);
				$this->dataRow = $combinedArray;
			}
			else{
				$arr = array_fill(0, count($data), "?" );
				$placeHolder = "(" . implode(", ", $arr ) . ")";
				$this->query .= $placeHolder;
				$this->dataRow = array_values($data);
				print_r($this->dataRow);
			}

		}

		function updateData($data, $condition){
			$columns = array_keys($data);

			$this->query = "UPDATE $this->name SET ";
			$a = array();

			foreach($data as $column=>$val){
				$a[] = $column . " = :" . $column;
				$this->dataRow[':' . $column] = $column;
			}

			$this->query .= implode(", ", $a) . " WHERE $condition";
		}

		function incrementCell($columnName, $value){
			$this->query = "UPDATE $this->name SET $columnName = :column_name + :value";
			$this->dataRow = array(":column_name"=>$columnName, ":value"=>$value);
		}

		function decreaseValue($columnName, $value){
			$this->query = "UPDATE $this->name SET :column_name = :column_name - :value";
			$this->dataRow = array("column_name"=>$columnName, "value"=>$value);
		}

		function getData($condition, $order, $order_type, $limit){
			$this->query = "SELECT * FROM $this->name";

			if($condition !== ""){
				$this->query .= " WHERE $condition";
			}

			if($order !== ""){
				$this->query .= " ORDER BY $order $order_type";
			}

			if($limit > 0){
				$this->query .= " LIMIT 0, $limit";
			}
		}

		function deleteRow($columnName, $operator, $value){
			$this->query = "DELETE FROM $this->name WHERE $columnName $operator :value";
			$this->dataRow = array(":value"=>$value);
		}

		function executeQuery(){
			if ($this->query == "")
				throw new Exception("Query not found, Please Create Query Before Executing", 1);
	
			try {
				$this->stmt = $this->db->prepare($this->query);
				$this->stmt->execute( $this->dataRow );
				$this->output = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
				$this->query = "";
			} catch (PDOException $e) {
				echo $e->getMessage();
			} 
		}

		function getJSON(){
			return json_encode($this->output);
		}
	}