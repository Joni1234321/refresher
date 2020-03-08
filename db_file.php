<?php 

    class DB {
        public $servername = "localhost";
        public $username = "root";
        public $password = "";
        public $dbname = "rfrsher";
    
        //UNSAFE: NOT SAFE FOR USER INPUT
        //ONLY USE FOR STATIC PURPOSES
        public function query_no_params ($sql) {

            // Create connection
            $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            // Check connection
            if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                    return;
            }
    
            $stmt = $conn->prepare($sql);
            
            $stmt->execute();
    
            $meta = $stmt->result_metadata();
            while ($field = $meta->fetch_field())
            {
                $result_names[] = &$row[$field->name];
            }
        
            call_user_func_array(array($stmt, 'bind_result'), $result_names);
            $returnvalue = NULL;
            while ($stmt->fetch()) {
                foreach($row as $key => $val)
                {
                    $c[$key] = $val;
                }
                $returnvalue[] = $c;
            }
    
            $stmt->close();
            $conn->close();
            
            return $returnvalue;
        }

        public function query ($sql, $param_type, $params){
        
            // Create connection
            $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            // Check connection
            if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                    return;
            }
    
            $stmt = $conn->prepare($sql);
            
            $stmt->bind_param($param_type, ...$params);
            $stmt->execute();
    
            $meta = $stmt->result_metadata();
            while ($field = $meta->fetch_field())
            {
                $result_names[] = &$row[$field->name];
            }
        
            call_user_func_array(array($stmt, 'bind_result'), $result_names);
            $returnvalue = NULL;
            while ($stmt->fetch()) {
                foreach($row as $key => $val)
                {
                    $c[$key] = $val;
                }
                $returnvalue[] = $c;
            }
    
            $stmt->close();
            $conn->close();
            
            return $returnvalue;
        }
    
        //DO MYSQL WITHOUT RETURNS
        public function query_no_return ($sql, $param_type, $params){                
    
            // Create connection
            $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            // Check connection
            if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                    return;
            }
    
            $stmt = $conn->prepare($sql);

            $stmt->bind_param($param_type, ...$params);
            $stmt->execute();
    
            $stmt->close();
            $conn->close();
            
        }

        public function query_no_params_no_return ($sql) {

            // Create connection
            $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            // Check connection
            if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                    return;
            }
    
            $stmt = $conn->prepare($sql);

            $stmt->execute();

            $stmt->close();
            $conn->close();
            
        }

        public function query_id ($sql, $param_type, $params){                

            // Create connection
            $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            // Check connection
            if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                    return;
            }

            $stmt = $conn->prepare($sql);
            
            $stmt->bind_param($param_type, ...$params);
            $stmt->execute();
            
            $id = $conn->insert_id;

            $stmt->close();
            $conn->close();

            return $id;
        }
    }



?>