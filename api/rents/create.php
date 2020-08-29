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

    $data = json_decode(file_get_contents("php://input"));

    $item->id = $data->id;
    $item->client_cpf = $data->client_cpf;
    $item->car_plate = $data->car_plate;
    $item->startdate = $data->startdate;
    $item->endDate = $data->endDate;
    $item->totalPrice = $data->totalPrice;
    $item->rentStatus = $data->rentStatus;
    
    if($item->createRent()){
        echo 'Rent created successfully.';
    } else{
        echo 'Rent could not be created.';
    }
?>