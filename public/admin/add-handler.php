<?php 


    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";

    $handler_name = trim($_POST['handler_name']);
    $handler_id = trim($_POST['handler_id']);
    

    if(empty($handler_name)){

        $result = "Entere a handler name.";

    }else{

        $handler = new Handler();

        if(!empty($handler_id)){

            $data = [
                "handler_id" => $handler_id,
                "handler_name" => strtoupper($handler_name)
            ];

            if($handler->update_handler($data) === true){
                $success = true;
                $result = "Handler successfully added.";
            }else{
                $result = "Error connecting to database.";
            }
        }else{

            if($handler->add_handler(strtoupper($handler_name)) === true){
                $success = true;
                $result = "Handler successfully added.";
            }else{
                $result = "Error connecting to database.";
            }
        }


    }

    echo json_encode([
        "result" => $result,
        "success" => $success
    ]);