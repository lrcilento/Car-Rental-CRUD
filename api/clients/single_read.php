<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once '../../config/database.php';
    include_once '../../models/clients.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Client($db);

    $item->cpf = isset($_GET['cpf']) ? $_GET['cpf'] : die();
  
    $item->getSingleClient();

    if($item->cpf != null){
        $client_arr = array(
            "cpf" =>  $item->cpf,
            "name" =>  $item->name,
            "address" =>  $item->address
        );
      
        http_response_code(200);
        echo json_encode($client_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Client not found.");
    }
?>