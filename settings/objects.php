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

		function insertRow($input){

			$data = $this->filterData($input);

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
				if( strpos($limit, ",") )
					$this->query = " LIMIT $limit";
				else
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

		function getColumnName(){
			$this->query = "SELECT column_name FROM information_schema.columns WHERE table_schema = '" . DATABASE . "' AND table_name = '$this->name'";
			$this->executeQuery();
		}

		function filterData($data){
			$this->getColumnName();
			$output = array();

			foreach($this->output as $row){
				$output[] = $row['column_name'];
			}

			$difference = array_diff( array_keys($data), $output );
			foreach($difference as $diff){
				unset( $data[$diff] );
			}

			return $data;
		}

		function getJSON(){
			return json_encode($this->output);
		}

		function lastInsertId(){
			return $this->db->lastInsertId();
		}
	}
