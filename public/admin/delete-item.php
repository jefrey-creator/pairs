<?php 


    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";

    $logs = new Logs();

    $item_id = trim($_POST['item_id']);
    if(empty($item_id)){

        $result = "Item not found.";

    }elseif(!intval($item_id)){

        $result = "Invalid item selected.";

    }elseif($item_id < 1){

        $result = "Item is already deleted.";

    }else{

        $item = new Item();
        $storage = new Storage();

        $item_data = $item->select_item_by_id($item_id);
        $uuid = $item_data->item_uuid;

        if($storage->delete_stored_item($uuid) === true){
            if($item->delete_item_by_uuid($uuid) === true){
                $success = true;
                $result = "Item successfully deleted.";
            }else{
                $result = "Item cannot be deleted.";
            }
        }else{
            $result = "Item cannot remove from the storage.";
        }

    }

    $act_data = [
        "user_id" => $decoded->data->username, 
        "action" => "Delete Item", 
        "ip_address" => $_SERVER['REMOTE_ADDR'],
        "details" => $result . "[Item ID:" .$item_id. "][Success:"  . $success. "]"
    ];

    $logs->insert_log($act_data);

    echo json_encode([
        "success" => $success,
        "result" => $result
    ]);