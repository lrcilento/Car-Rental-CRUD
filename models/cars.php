<?php
    class Car{

        private $conn;

        private $db_table = "Cars";

        public $plate;
        public $model;
        public $year;
        public $color;
        public $dailyRate;
        public $rentStatus;

        public function __construct($db){
            $this->conn = $db;
        }

        public function getCar(){
            $sqlQuery = "SELECT plate, model, year, color, dailyRate, rentStatus FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function createCar(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        plate = :plate, 
                        model = :model, 
                        year = :year, 
                        color = :color,
                        dailyRate = :dailyRate, 
                        rentStatus = :rentStatus";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->plate=htmlspecialchars(strip_tags($this->plate));
            $this->model=htmlspecialchars(strip_tags($this->model));
            $this->year=htmlspecialchars(strip_tags($this->year));
            $this->color=htmlspecialchars(strip_tags($this->color));
            $this->dailyRate=htmlspecialchars(strip_tags($this->dailyRate));
            $this->rentStatus=htmlspecialchars(strip_tags($this->rentStatus));
        
            $stmt->bindParam(":plate", $this->plate);
            $stmt->bindParam(":model", $this->model);
            $stmt->bindParam(":year", $this->year);
            $stmt->bindParam(":color", $this->color);
            $stmt->bindParam(":dailyRate", $this->dailyRate);
            $stmt->bindParam(":rentStatus", $this->rentStatus);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        public function getSingleCar(){
            $sqlQuery = "SELECT
                        plate, 
                        model, 
                        year, 
                        color, 
                        dailyRate,
                        rentStatus
                      FROM
                        ". $this->db_table ."
                    WHERE 
                        plate = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->plate);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->plate = $dataRow['plate'];
            $this->model = $dataRow['model'];
            $this->year = $dataRow['year'];
            $this->color = $dataRow['color'];
            $this->dailyRate = $dataRow['dailyRate'];
            $this->rentStatus = $dataRow['rentStatus'];
        }        

        public function updateCar(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        model = :model, 
                        year = :year, 
                        color = :color, 
                        dailyRate = :dailyRate,
                        rentStatus = :rentStatus
                    WHERE 
                        plate = :plate";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->plate=htmlspecialchars(strip_tags($this->plate));
            $this->model=htmlspecialchars(strip_tags($this->model));
            $this->year=htmlspecialchars(strip_tags($this->year));
            $this->color=htmlspecialchars(strip_tags($this->color));
            $this->dailyRate=htmlspecialchars(strip_tags($this->dailyRate));
            $this->rentStatus=htmlspecialchars(strip_tags($this->rentStatus));
        
            $stmt->bindParam(":plate", $this->plate);
            $stmt->bindParam(":model", $this->model);
            $stmt->bindParam(":year", $this->year);
            $stmt->bindParam(":color", $this->color);
            $stmt->bindParam(":dailyRate", $this->dailyRate);
            $stmt->bindParam(":rentStatus", $this->rentStatus);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        function deleteCar(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE plate = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->plate=htmlspecialchars(strip_tags($this->plate));
        
            $stmt->bindParam(1, $this->plate);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
?>