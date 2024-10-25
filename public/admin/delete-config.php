<?php 
    include_once 'auth.php';

    header("Content-Type: application/json");

    $success = false;
    $result = "";
    $logs = new Logs();

    $config_id = trim($_POST['config_id']);

    if(!intval($config_id) || empty($config_id)){
        $result = "Configuration does not exist.";
    }else{

        $config = new Config();

        if($config->delete_config($config_id) === true){
            $success = true;
            $result = "Configuration successfully deleted.";
        }else{
            $result = "Configuration not deleted.";
        }
    }

    $act_data = [
        "user_id" => $decoded->data->username, 
        "action" => "Delete email config", 
        "ip_address" => $_SERVER['REMOTE_ADDR'],
        "details" => $result . " [ID:" .$config_id. "]"
    ];

    $logs->insert_log($act_data);

    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);