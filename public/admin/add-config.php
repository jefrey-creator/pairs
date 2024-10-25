<?php 
    include_once 'auth.php';

    header("Content-Type: application/json");

    $success = false;
    $result = "";
    $logs = new Logs();

    $subject = trim($_POST['subject']);
    $tag = trim($_POST['tag']);
    $message = trim($_POST['message']);
    $config_id = trim($_POST['config_id']);


    if(empty($subject)){
        $result = "Subject is required.";
    }elseif(empty($tag)){
        $result = "Tag is required.";
    }elseif(empty($message)){
        $result = "Message is required.";
    }else{

        $config = new Config();

        if(empty($config_id)){
            $data = [
                "tag" => $tag, 
                "message" => $message, 
                "subject" => $subject
            ];
    
            if($config->add_config($data) === true){
                $result = "Configuration successfully added.";
                $success = true;
            }else{
                $result = "Configuration not saved.";
            }
        }else{
            $data = [
                
                "message" => $message, 
                "subject" => $subject,
                "config_id" => $config_id
            ];
    
            if($config->update_config($data) === true){
                $result = "Configuration successfully updated.";
                $success = true;
            }else{
                $result = "Configuration not updated.";
            }
        }
    }

    $act_data = [
        "user_id" => $decoded->data->username, 
        "action" => (empty($config_id)) ? "Add email config" : "Update email config", 
        "ip_address" => $_SERVER['REMOTE_ADDR'],
        "details" => (empty($config_id)) ? "Data:[ Subject: " .$subject . "]" : "Data: [ID: " .$config_id. "]"
    ];

    $logs->insert_log($act_data);


    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);