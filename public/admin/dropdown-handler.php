<?php 


    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";

    $handler = new Handler();

    if($handler->dropdown_handler() === false){
        $result = "No data available.";
    }else{
        $success = true;
        $result = $handler->dropdown_handler();
    }


    echo json_encode([
        "result" => $result,
        "success" => $success
    ]);