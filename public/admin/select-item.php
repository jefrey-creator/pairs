<?php 

    include_once 'auth.php';

    header("Content-Type: application/json");
    $success = false;
    $result = "";

    $item_id = trim($_GET['id']);

    if(empty($item_id) || !intval($item_id) || $item_id <= 0){
        $result = "Item not found.";
    }else{
        
        $item = new Item();

        if($item->select_item_by_id($item_id) === false){
            $result = "Item not found.";
        }else{
            $result = $item->select_item_by_id($item_id);
            $success = true;
        }

    }

    echo json_encode([
        "result" => $result,
        "success" => $success
    ]);