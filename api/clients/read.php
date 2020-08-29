<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../models/clients.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Client($db);

    $stmt = $items->getClient();
    $itemCount = $stmt->rowCount();


    echo json_encode($itemCount);

    if($itemCount > 0){
        
        $clientArr = array();
        $clientArr["body"] = array();
        $clientArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "cpf" => $cpf,
                "name" => $name,
                "address" => $address
            );

            array_push($clientArr["body"], $e);
        }
        echo json_encode($clientArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>