<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../models/cars.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Car($db);

    $item->plate = isset($_GET['plate']) ? $_GET['plate'] : die();
  
    $item->getSingleCar();

    if($item->plate != null){
        $car_arr = array(
            "plate" => $item->plate,
            "model" => $item->model,
            "year" => $item->year,
            "color" => $item->color,
            "dailyRate" => $item->dailyRate,
            "rentStatus" => $item->rentStatus
        );
      
        http_response_code(200);
        echo json_encode($car_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Car not found.");
    }
?>