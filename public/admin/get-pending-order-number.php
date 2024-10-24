<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");

    $borrow = new Borrow();

    $success = false;
    $result = "";
    $status = 1;

    if($borrow->order_number($status) === false){
        $result = "No data available.";
    }else{
        $success = true;
        $result = $borrow->order_number($status);
    }
    
    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);