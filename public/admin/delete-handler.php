<?php 


    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";
    $handler = new Handler();
    $logs = new Logs();

    $handler_id = trim($_POST['handler_id']);
    $old_name = $handler->select_handler($handler_id);
    $old_handler_name = $old_name->handler_name;
    

    if(empty($handler_id) OR !intval($handler_id)){

        $result = "Data not available.";

    }else{

        

        if($handler->delete_handler($handler_id) === true){
        
            $result = "Handler successfully removed.";
            $success = true;
        }else{
            $result = "Error connecting to database.";
        }

    }

    $act_data = [
        "user_id" => $decoded->data->username, 
        "action" => (!empty($handler_id)) ? "Update handler" : "Add handler", 
        "ip_address" => $_SERVER['REMOTE_ADDR'],
        "details" => $result . "[ID: ".$handler_id."][Data: ".$old_handler_name."] [Success: ".$success."]"
    ];

    $logs->insert_log($act_data);

    echo json_encode([
        "result" => $result,
        "success" => $success
    ]);