<?php 
    include_once 'auth.php';

    header("Content-Type: application/json");

    $success = false;
    $result = "";

    $config_id = trim($_GET['config_id']);

    if(!intval($config_id) || empty($config_id)){
        $result = "You are trying to update a not existing configuration.";
    }else{
        $config = new Config();

        if($config->select_config($config_id) === false){
            $result = "Configuration not found.";
        }else{
            $result = $config->select_config($config_id);
            $success = true;
        }
    }


    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);