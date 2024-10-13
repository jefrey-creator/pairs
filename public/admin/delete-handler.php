<?php 


    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";

    $handler_id = trim($_POST['handler_id']);
    

    if(empty($handler_id) OR !intval($handler_id)){

        $result = "Data not available.";

    }else{

        $handler = new Handler();

        if($handler->delete_handler($handler_id) === true){
        
            $result = "Handler successfully removed.";
            $success = true;
        }else{
            $result = "Error connecting to database.";
        }

    }

    echo json_encode([
        "result" => $result,
        "success" => $success
    ]);