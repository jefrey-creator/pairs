<?php 


    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";
    $handler = new Handler();
    $logs = new Logs();

    $handler_name = trim($_POST['handler_name']);
    $handler_id = trim($_POST['handler_id']);

    $old_name = $handler->select_handler($handler_id);
    $old_handler_name = $old_name->handler_name;
    

    if(empty($handler_name)){

        $result = "Entere a handler name.";

    }else{

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

    $act_data = [
        "user_id" => $decoded->data->username, 
        "action" => (!empty($handler_id)) ? "Update handler" : "Add handler", 
        "ip_address" => $_SERVER['REMOTE_ADDR'],
        "details" => (!empty($handler_id)) ? $result . "[ID: ".$handler_id."][Old: ".$old_handler_name."][New: ".$handler_name."][Success: ".$success."]" : $result . "[Data: ". $handler_name ."][Success: ".$success."]"
    ];

    $logs->insert_log($act_data);
    

    echo json_encode([
        "result" => $result,
        "success" => $success
    ]);