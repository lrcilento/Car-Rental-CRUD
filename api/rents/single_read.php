<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../models/rents.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Rent($db);

    $item->id = isset($_GET['id']) ? $_GET['id'] : die();
  
    $item->getSingleRent();

    if($item->id != null){
        $rent_arr = array(
            "id" => $item->id,
            "client_cpf" => $item->client_cpf,
            "car_plate" => $item->car_plate,
            "startdate" => $item->startdate,
            "endDate" => $item->endDate,
            "totalPrice" => $item->totalPrice,
            "rentStatus" => $item->rentStatus
        );
      
        http_response_code(200);
        echo json_encode($rent_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Rent not found.");
    }
?>