<?php 
    include_once 'auth.php';

    header("Content-Type: application/json");

    $success = false;
    $result = "";

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


    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);