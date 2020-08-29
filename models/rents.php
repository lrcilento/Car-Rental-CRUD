<?php
    class Rent{

        private $conn;

        private $db_table = "Rents";

        public $id;
        public $client_cpf;
        public $car_plate;
        public $startdate;
        public $endDate;
        public $totalPrice;
        public $rentStatus;

        public function __construct($db){
            $this->conn = $db;
        }

        public function getRent(){
            $sqlQuery = "SELECT id, client_cpf, car_plate, startdate, endDate, totalPrice, rentStatus FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function createRent(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        id = :id, 
                        client_cpf = :client_cpf, 
                        car_plate = :car_plate, 
                        startdate = :startdate,
                        endDate = :endDate, 
                        totalPrice = :totalPrice, 
                        rentStatus = :rentStatus";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->client_cpf=htmlspecialchars(strip_tags($this->client_cpf));
            $this->car_plate=htmlspecialchars(strip_tags($this->car_plate));
            $this->startdate=htmlspecialchars(strip_tags($this->startdate));
            $this->endDate=htmlspecialchars(strip_tags($this->endDate));
            $this->totalPrice=htmlspecialchars(strip_tags($this->totalPrice));
            $this->rentStatus=htmlspecialchars(strip_tags($this->rentStatus));
        
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":client_cpf", $this->client_cpf);
            $stmt->bindParam(":car_plate", $this->car_plate);
            $stmt->bindParam(":startdate", $this->startdate);
            $stmt->bindParam(":endDate", $this->endDate);
            $stmt->bindParam(":totalPrice", $this->totalPrice);
            $stmt->bindParam(":rentStatus", $this->rentStatus);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function getSingleRent(){
            $sqlQuery = "SELECT
                        id, 
                        client_cpf, 
                        car_plate, 
                        startdate, 
                        endDate,
                        totalPrice,
                        rentStatus
                      FROM
                        ". $this->db_table ."
                    WHERE 
                        id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->id = $dataRow['id'];
            $this->client_cpf = $dataRow['client_cpf'];
            $this->car_plate = $dataRow['car_plate'];
            $this->startdate = $dataRow['startdate'];
            $this->endDate = $dataRow['endDate'];
            $this->totalPrice = $dataRow['totalPrice'];
            $this->rentStatus = $dataRow['rentStatus'];
        }        

        public function updateRent(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        client_cpf = :client_cpf, 
                        car_plate = :car_plate, 
                        startdate = :startdate, 
                        endDate = :endDate,
                        totalPrice = :totalPrice,
                        rentStatus = :rentStatus
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
            $this->client_cpf=htmlspecialchars(strip_tags($this->client_cpf));
            $this->car_plate=htmlspecialchars(strip_tags($this->car_plate));
            $this->startdate=htmlspecialchars(strip_tags($this->startdate));
            $this->endDate=htmlspecialchars(strip_tags($this->endDate));
            $this->totalPrice=htmlspecialchars(strip_tags($this->totalPrice));
            $this->rentStatus=htmlspecialchars(strip_tags($this->rentStatus));
        
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":client_cpf", $this->client_cpf);
            $stmt->bindParam(":car_plate", $this->car_plate);
            $stmt->bindParam(":startdate", $this->startdate);
            $stmt->bindParam(":endDate", $this->endDate);
            $stmt->bindParam(":totalPrice", $this->totalPrice);
            $stmt->bindParam(":rentStatus", $this->rentStatus);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        function deleteRent(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>