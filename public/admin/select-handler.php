<?php 


    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";

    $handler_id = trim($_GET['handler_id']);
    

    if(empty($handler_id) OR !intval($handler_id)){

        $result = "Data not available.";

    }else{

        $handler = new Handler();

        if($handler->select_handler($handler_id) === false){
           
            $result = "No available data.";
        }else{
            $result = $handler->select_handler($handler_id);
            $success = true;
        }

    }

    echo json_encode([
        "result" => $result,
        "success" => $success
    ]);