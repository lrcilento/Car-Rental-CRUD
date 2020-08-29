<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once '../../config/database.php';
    include_once '../../models/rents.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Rent($db);

    $stmt = $items->getRent();
    $itemCount = $stmt->rowCount();


    echo json_encode($itemCount);

    if($itemCount > 0){
        
        $rentArr = array();
        $rentArr["body"] = array();
        $rentArr["itemCount"] = $itemCount;

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $e = array(
                "id" => $id,
                "client_cpf" => $client_cpf,
                "car_plate" => $car_plate,
                "startdate" => $startdate,
                "endDate" => $endDate,
                "totalPrice" => $totalPrice,
                "rentStatus" => $rentStatus
            );

            array_push($rentArr["body"], $e);
        }
        echo json_encode($rentArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>