<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");
    $item = new Item();
    $logs = new Logs();
    $success = false;
    $result = "";

    $item_condition = trim(strtoupper($_POST['item_condition']));

    if(empty($item_condition)){
        $result = "Condition is required.";
    }else{
        
        if($item->add_item_condition($item_condition)=== true){
            
            $success = true;
            $result = "Condition successfully saved.";
        }else{
            $result = "Error saving data.";
        }
    }

    $act_data = [
        "user_id" => $decoded->data->username, 
        "action" => "Add Item Condition", 
        "ip_address" => $_SERVER['REMOTE_ADDR'],
        "details" => $result . "Data: [" . $item_condition ."]"
    ];

    $logs->insert_log($act_data);

    echo json_encode([
        "result" => $result,
        "success" => $success
    ]);