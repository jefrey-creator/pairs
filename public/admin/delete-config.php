<?php 
    include_once 'auth.php';

    header("Content-Type: application/json");

    $success = false;
    $result = "";

    $config_id = trim($_POST['config_id']);

    if(!intval($config_id) || empty($config_id)){
        $result = "Configuration does not exist.";
    }else{

        $config = new Config();

        if($config->delete_config($config_id) === true){
            $success = true;
            $result = "Configuration successfully updated.";
        }else{
            $result = "Configuration not deleted.";
        }

    }

    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);