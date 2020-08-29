<?php
    class Client{

        private $conn;

        private $db_table = "Clients";

        public $cpf;
        public $name;
        public $address;
        public $color;
        public $dailyRate;
        public $rentStatus;

        public function __construct($db){
            $this->conn = $db;
        }

        public function getClient(){
            $sqlQuery = "SELECT cpf, name, address FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function createClient(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        cpf = :cpf, 
                        name = :name, 
                        address = :address";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->cpf=htmlspecialchars(strip_tags($this->cpf));
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->address=htmlspecialchars(strip_tags($this->address));
        
            $stmt->bindParam(":cpf", $this->cpf);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":address", $this->address);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function getSingleClient(){
            $sqlQuery = "SELECT
                        cpf, 
                        name, 
                        address
                      FROM
                        ". $this->db_table ."
                    WHERE 
                        cpf = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->cpf);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->cpf = $dataRow['cpf'];
            $this->name = $dataRow['name'];
            $this->address = $dataRow['address'];
        }        

        public function updateClient(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        name = :name, 
                        address = :address
                    WHERE 
                        cpf = :cpf";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->cpf=htmlspecialchars(strip_tags($this->cpf));
            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->address=htmlspecialchars(strip_tags($this->address));
        
            $stmt->bindParam(":cpf", $this->cpf);
            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":address", $this->address);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        function deleteClient(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE cpf = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->cpf=htmlspecialchars(strip_tags($this->cpf));
        
            $stmt->bindParam(1, $this->cpf);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>