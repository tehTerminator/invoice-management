<?php

    class DataAdapter{
        private $connection;
        private $tableName;
        private $output;
        private $query;
        private $userData;
        
        public function __construct($connection ,$tableName){
            $this->connection = $connection;
            $this->tableName = $tableName;
            $this->output = array();
        }
        
        /**
        * select
        *
        * Generates Query to select Data from SQL
        *
        * @params is array containing 
        *
        * conditions as array
        * conditional_operator is either AND or OR
        * may contains Order By, Limit etc 
        */
        private function select($params=null){

            $this->output['params'] = $params;

            if( isset($params['columnNames'] ) ){
                $cols = implode(',', $params['columnNames'] );
            } else {
                $cols = "*";
            }

            unset( $params['columnNames'] );

            $this->query = "SELECT {$cols} FROM {$this->tableName}";

            if( isset($params['conditions'] ) ){
                $operator = " AND ";

                $this->query .= isset( $params['join'] ) ? " join " . $params['join'] . " AND " : " WHERE "; 

                if( isset($params['conditional_operator'] ) ) {
                    $operator = ' ' . $params['conditional_operator'] . ' ';
                    unset( $params['conditional_operator'] );
                }
                                           
                foreach ($params['conditions'] as $key => $value) {
                    if( is_array($value) ){
                        $comparison_operator = " " . $value[0] . " ";
                        $val = $value[1];
                    } else {
                        $comparison_operator = " = ";
                        $val = $value;
                    }
                    $this->query .= $key . $comparison_operator . $val . " " . $operator;
                }
                if( $operator == " AND ")
                    $this->query = substr($this->query, 0, strlen($this->query) - 5);
                else if( $operator == " OR ")
                    $this->query = substr($this->query, 0, strlen($this->query) - 4);
                    
                unset( $params['conditions'] );
                unset( $params['join'] );
            }
            if( ! empty($params) ){
                foreach ($params as $key => $value) {
                    $this->query .= " " . $key . " " . $value;
                }
            }
        }
        
        private function insert($params){
            $this->query = "INSERT INTO {$this->tableName}(" . implode(', ', $params['columnNames']) . ") VALUES(";
            $cols = array_map( function($column){
                return ":" . $column;
            }, $params['columnNames'] );
            
            $this->query .= implode(", ", $cols) . ")";
        }
        
        private function update($params){
            $this->query = "UPDATE {$this->tableName} SET " . implode(", ", array_map(
                function($key){
                    return $key . " = :" . $key;
                },
                array_keys($params['userData'])
            )) . " WHERE id = {$params['conditions']['id']}";
        }
        
        private function delete($id){
            $this->query = "DELETE FROM {$this->tableName} WHERE id = {$id}";
        }
        
        public function generateQuery($type, $params=null){
            if( isset($params['userData'] ) ){
                $this->userData = $params['userData'];
                foreach ($this->userData as $key => $value) {
                    $this->userData[":" . $key] = $value;
                    unset( $this->userData[$key] );
                }
                $this->output['userData'] = $this->userData;
            }
            else
                $this->userData = array();
                
            $type = strtoupper($type);
            
            if( $type == "SELECT" )
                $this->select($params);
            else if( $type == "INSERT" )
                $this->insert( $params );
            else if( $type == "UPDATE" )
                $this->update( $params );
            else if( $type == "DELETE" )
                $this->delete( $params['conditions']['id'] );
            else
                $this->query = $params['custom_query']; 
                
            $this->output['query'] = $this->query;
        }
        
        public function getQuery(){
            echo $this->query;
        }
        
        public function execute(){
            
            $stmt = null;
            $result = false;
            
            try{
                $stmt = $this->connection->prepare($this->query);
                $stmt->execute( $this->userData );
                
                $this->output['affectedRows'] = $stmt->rowCount();
                $this->output['lastInsertId'] = $this->connection->lastInsertId();
                $this->output['serverData'] = $stmt->fetchAll();
                
            } catch( PDOStatement $ex1 ){
                $output['status'] = false;
                $output['exception'][] = $ex1->getMessage();
            } catch( PDOException $ex2 ){
                $output['status'] = false;
                $output['exception'][] = $ex2->getMessage();
            }
        }
        
        public function echo_output(){
            echo json_encode( $this->output );
        }
    }
