<?php
	include_once ROOT_DIR . "/functions.php";

	$log = "object_log.txt";

	class table{

		private $name;
		public $dataRow;
		private $db;
		public $query;
		private $stmt;
		private $output;
		private $columnNames;


		function __construct($db, $tableName){
			$this->db = $db;
			$this->name = $tableName;

			$this->getColumnName();

			foreach($this->output as $row){
				$this->columnNames[] = $row['column_name'];
			}
		}

		function insertRow($input){

			$input = $this->filterData($input);

			if( isMulti($input) ){
				$colName = array_keys($input[0]);
			}
			else{
				$colName = array_keys($input);
			}

			$this->query = "INSERT INTO $this->name(" . implode(", ", $colName) . ") VALUES (";

			foreach($colName as &$col){
				$col = ":" . $col;
			}

			$this->query .= implode(", ", $colName) . ")";
			$this->dataRow = $input;

		}

		function updateData($data, $condition){
			$columns = array_keys($data);

			$this->query = "UPDATE $this->name SET ";
			$a = array();

			foreach($data as $column=>$val){
				$a[] = $column . " = :" . $column;
				$this->dataRow[':' . $column] = $val;
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
				
				if( isMulti($this->dataRow) ){
					foreach($this->dataRow as $row)
						$this->stmt->execute($row);
				}
				else{
					$this->stmt->execute( $this->dataRow );
				}					

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
			$output = array();

			foreach($this->output as $row){
				$output[] = $row['column_name'];
			}



			if( isMulti($data) ){
				$difference = array_diff(array_keys($data[0]), $output);
				foreach($difference as $diff){
					foreach($data as &$d){
						unset( $d[$diff] );
					}
				}
			}
			else{
				$difference = array_diff(array_keys($data), $output);
				foreach($difference as $diff){
					unset( $data[$diff] );
				}
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
